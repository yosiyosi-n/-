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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'title'   => 'required|string|max:255',
        'content' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attributeは必須入力です。',
            'email'    => '正しいメールアドレスの形式で入力してください。',
            'max'      => ':attributeはmax文字以内で入力してください。',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'    => 'お名前',
            'email'   => 'メールアドレス',
            'title'   => '件名',
            'content' => 'お問い合わせ内容',
        ];
    }
}
