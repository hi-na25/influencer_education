<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 💡 必ず true に書き換えてください
    }

    public function rules(): array
    {
        return [
            // 💡 パスワードのルールだけをここに書きます
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            // 💡 以前正しく出ていたパスワード用のメッセージに戻します
            'current_password.required' => '現在設定されているパスワードと一致しません',
            'new_password.required'     => '新パスワードと一致しません',
            'new_password.min'          => '新パスワードは8文字以上で入力してください',
            'new_password.confirmed'    => '新パスワードと一致しません',
        ];
    }
}
