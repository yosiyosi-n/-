<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Http\Requests\InquiryRequest;

class InquiryController extends Controller
{
    public function index()
    {
        return view('inquiry.index');
    }

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

    public function thanks(InquiryRequest $request)
    {
        Inquiry::create([
            'first_name'      => $request->first_name,
            'last_name'       => $request->last_name,
            'gender'          => $request->gender,
            'email'           => $request->email,
            'telephone_one'   => $request->telephone_one,
            'telephone_two'   => $request->telephone_two,
            'telephone_three' => $request->telephone_three,
            'address'         => $request->address,
            'building_name'   => $request->building_name,
            'inquiry_type'    => $request->inquiry_type,
            'content'         => $request->content,
        ]);

        return view('inquiry.thanks');
    }

    public function admin()
    {
        $inquiries = Inquiry::all();
        return view('inquiry.admin', compact('inquiries'));
    }

    public function search(Request $request)
    {
        $query = Inquiry::query();

        if ($request->filled('name')) {
            $searchWord = $request->input('name');
            $query->where(function ($subQuery) use ($searchWord) {
                $subQuery->where('first_name', 'LIKE', '%' . $searchWord . '%')
                         ->orWhere('last_name', 'LIKE', '%' . $searchWord . '%');
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        $inquiries = $query->get();

        return view('inquiry.admin', compact('inquiries'));
    }

    public function reset()
    {
        return redirect()->route('admin.index');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        if (empty($id)) {
            return redirect()->route('admin.index');
        }

        $inquiry = Inquiry::find($id);

        if (empty($inquiry)) {
            return redirect()->route('admin.index');
        }

        $inquiry->delete();

        return redirect()->route('admin.index');
    }

    public function export()
    {
        $inquiries = Inquiry::all();

        if ($inquiries->isEmpty()) {
            return redirect()->route('admin.index');
        }

        $fileName = 'inquiries_' . date('YmdHis') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function () use ($inquiries) {
            $fileHandle = fopen('php://output', 'w');
            fwrite($fileHandle, "\xEF\xBB\xBF");

            fputcsv($fileHandle, ['ID', '姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', '種類', 'お問い合わせ内容', '送信日時']);

            foreach ($inquiries as $inquiry) {
                // 性別の数値を日本語テキストに変換
                $genderText = match ((int)$inquiry->gender) {
                    1 => '男性',
                    2 => '女性',
                    3 => 'その他',
                    default => '不明',
                };

                // お問い合わせの種類の数値を日本語テキストに変換
                $inquiryTypeText = match ((int)$inquiry->inquiry_type) {
                    1 => '商品のお届けについて',
                    2 => '商品の交換について',
                    3 => '商品トラブル',
                    4 => 'ショップへのお問い合わせ',
                    5 => 'その他',
                    default => '不明',
                };

                // 電話番号を結合
                $telephoneNumber = "{$inquiry->telephone_one}-{$inquiry->telephone_two}-{$inquiry->telephone_three}";

                fputcsv($fileHandle, [
                    $inquiry->id,
                    $inquiry->first_name,
                    $inquiry->last_name,
                    $genderText,
                    $inquiry->email,
                    $telephoneNumber,
                    $inquiry->address,
                    $inquiry->building_name,
                    $inquiryTypeText,
                    $inquiry->content,
                    $inquiry->created_at->format('Y/m/d H:i'),
                ]);
            }

            fclose($fileHandle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
