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
            'first_name'      => 'required|string|max:4',
            'last_name'       => 'required|string|max:4',
            'gender'          => 'required|in:1,2,3',
            'email'           => 'required|email|max:255',
            'telephone_one'   => 'required|regex:/^[0-9]+$/|max:5',
            'telephone_two'   => 'required|regex:/^[0-9]+$/|max:5',
            'telephone_three' => 'required|regex:/^[0-9]+$/|max:5',
            'address'         => 'required|string|max:255',
            'building_name'   => 'nullable|string|max:255',
            'inquiry_type'    => 'required|in:1,2,3,4,5',
            'content'         => 'required|string|max:120',
        ];
    }

    /**
     * 💡 追記：エラーメッセージを英語から仕様書通りの日本語に一括翻訳します
     */
    public function messages(): array
    {
        return [
            'required' => ':attributeを入力してください',
            'gender.required' => '性別を選択してください',
            'inquiry_type.required' => 'お問い合わせの種類を選択してください',
            'email'    => 'メールアドレスは「ユーザー名@ドメイン」の形式で入力してください',
            'regex'    => ':attributeは半角数字で入力してください',
            'max'      => ':attributeは:max文字以内で入力してください',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'first_name'      => '姓',
            'last_name'       => '名',
            'gender'          => '性別',
            'email'           => 'メールアドレス',
            'telephone_one'   => '電話番号',
            'telephone_two'   => '電話番号',
            'telephone_three' => '電話番号',
            'address'         => '住所',
            'building_name'   => '建物名',
            'inquiry_type'    => 'お問い合わせの種類',
            'content'         => 'お問い合わせ内容',
        ];
    }
}
