<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        // 💡 解決策：現在リクエストされているURLの末尾が「register」を含むかどうかを判定します
        $isRegister = str_contains($this->url(), 'register');

        return [
            // お名前：会員登録時のみ入力必須にします
            'name'     => $isRegister ? 'required|string|max:255' : 'nullable',
            
            // 💡 メールアドレス：会員登録時のみ重複チェック(unique)を行い、ログイン時は必須チェックだけを適用します
            'email'    => $isRegister ? 'required|email|unique:users,email|max:255' : 'required|email|max:255',
            
            // パスワード必須
            'password' => 'required|string|min:8|max:255',
        ];
    }

    /**
     * 認証画面のエラーメッセージを漏れなく綺麗な日本語に翻訳・一括管理します
     */
    public function messages(): array
    {
        return [
            'required' => ':attributeを入力してください',
            'email'    => 'メールアドレスは「ユーザー名@ドメイン」の形式で入力してください',
            'unique'   => '既に入力されたメールアドレスが存在します',
            'min'      => ':attributeは:min文字以上で入力してください',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name'     => 'お名前',
            'email'    => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}

