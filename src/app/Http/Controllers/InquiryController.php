<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 仕様書に準拠した Contact モデルを正確に読み込みます
use App\Models\Contact;
use App\Http\Requests\InquiryRequest;

class InquiryController extends Controller
{
    /**
     * 入力画面の表示
     */
    public function index()
    {
        return view('inquiry.index');
    }

    /**
     * 確認画面への遷移処理
     */
    public function confirm(InquiryRequest $request)
    {
        $inputs = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'telephone_one',
            'telephone_two',
            'telephone_three',
            'address',
            'building_name',
            'inquiry_type',
            'content'
        ]);

        return view('inquiry.confirm', compact('inputs'));
    }

    /**
     * 完了画面（仕様書に沿ったデータベース保存処理）
     */
    public function thanks(InquiryRequest $request)
    {
        // 3分割された電話番号を、仕様書通りの「tel」カラム1つに綺麗に合体させます
        $telephoneNumber = $request->telephone_one . $request->telephone_two . $request->telephone_three;

        // テーブル仕様書通りのカラム名にマッピングして保存を確定させます
        Contact::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'gender'     => $request->gender,
            'email'      => $request->email,
            'tel'        => $telephoneNumber,
            'address'    => $request->address,
            'building'   => $request->building_name,
            'categry_id' => $request->inquiry_type,
            'detail'     => $request->content,
        ]);

        return view('inquiry.thanks');
    }

    /**
     * 💡 改良：管理画面の初期表示 ＆ 高度な一括検索処理をGET通信1本へ完全一本化
     */
    public function admin(Request $request)
    {
        $query = Contact::query();

        // 1. キーワード（名前・メール）横断検索
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('first_name', 'LIKE', '%' . $keyword . '%')
                         ->orWhere('last_name', 'LIKE', '%' . $keyword . '%')
                         ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            });
        }

        // 2. 性別：「all」以外が選ばれた時のみしっかりと絞り込みます
        if ($request->filled('gender') && $request->input('gender') !== 'all') {
            $query->where('gender', $request->input('gender'));
        }

        // 3. お問い合わせの種類：「all」以外が選ばれた時のみしっかりと絞り込みます
        if ($request->filled('inquiry_type') && $request->input('inquiry_type') !== 'all') {
            $query->where('categry_id', $request->input('inquiry_type'));
        }

        // 4. 生年月日日付検索
        if ($request->filled('birth_date')) {
            $query->whereDate('birth_date', $request->input('birth_date'));
        }

        // ページネーションを崩さずに検索結果を10件ずつスマートに取得します
        $contacts = $query->paginate(7);

        return view('inquiry.admin', compact('contacts'));
    }

    /**
     * 管理画面でのデータ削除処理
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {
            return redirect()->route('admin.index');
        }

        $contact = Contact::find($id);

        if (empty($contact)) {
            return redirect()->route('admin.index');
        }

        $contact->delete();

        return redirect()->route('admin.index');
    }

    /**
     * CSVダウンロード機能（新テーブル・新カラム名に完全対応版）
     */
    public function export()
    {
        $contacts = Contact::all();

        if ($contacts->isEmpty()) {
            return redirect()->route('admin.index');
        }

        $fileName = 'contacts_' . date('YmdHis') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function () use ($contacts) {
            $fileHandle = fopen('php://output', 'w');
            fwrite($fileHandle, "\xEF\xBB\xBF");

            fputcsv($fileHandle, ['ID', '姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', '種類', 'お問い合わせ内容', '送信日時']);

            foreach ($contacts as $contact) {
                // 性別の数値を日本語テキストに変換
                $genderText = match ((int)$contact->gender) {
                    1 => '男性',
                    2 => '女性',
                    3 => 'その他',
                    default => '不明',
                };

                // お問い合わせの種類の数値を日本語テキストに変換
                $inquiryTypeText = match ((int)$contact->categry_id) {
                    1 => '商品のお届けについて',
                    2 => '商品の交換について',
                    3 => '商品トラブル',
                    4 => 'ショップへのお問い合わせ',
                    5 => 'その他',
                    default => '不明',
                };

                fputcsv($fileHandle, [
                    $contact->id,
                    $contact->first_name,
                    $contact->last_name,
                    $genderText,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $inquiryTypeText,
                    $contact->detail,
                    $contact->created_at->format('Y/m/d H:i'),
                ]);
            }

            fclose($fileHandle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
