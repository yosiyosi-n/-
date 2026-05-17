<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'gender'          => 'required|in:1,2,3',
            'email'           => 'required|email|max:255',
            'telephone_one'   => 'required|string|max:255',
            'telephone_two'   => 'required|string|max:255',
            'telephone_three' => 'required|string|max:255',
            'address'         => 'required|string|max:255',
            'building_name'   => 'nullable|string|max:255', // 建物名は任意（nullable）
            'inquiry_type'    => 'required|in:1,2,3,4,5',
            'content'         => 'required|string',
        ];
    }

    /**
     * 項目名と連動する日本語のエラーメッセージテンプレート
     */
    public function messages(): array
    {
        return [
            'required' => ':attributeは必須入力です。',
            'email'    => '正しいメールアドレスの形式で入力してください。',
            'max'      => ':attributeは:max文字以内で入力してください。',
            'in'       => '正しい選択肢を選んでください。',
        ];
    }

    /**
     * 英語のカラム名を綺麗な日本語に翻訳
     */
    public function attributes(): array
    {
        return [
            'first_name'      => '姓',
            'last_name'       => '名',
            'gender'          => '性別',
            'email'           => 'メールアドレス',
            'telephone_one'   => '電話番号（市外局番）',
            'telephone_two'   => '電話番号（市内局番）',
            'telephone_three' => '電話番号（加入者番号）',
            'address'         => '住所',
            'building_name'   => '建物名',
            'inquiry_type'    => 'お問い合わせの種類',
            'content'         => 'お問い合わせの内容',
        ];
    }
}
