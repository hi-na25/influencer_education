<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * デフォルトは false 、変えないと「403 Forbidden」エラーになる。
     */
    public function authorize()
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            // 💡 もともとあったパスワード用のルール
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',

            // 💡 今回追加するプロフィールのルール（コンマで繋げて一緒に書きます）
            'name' => 'required|string|max:255', // ※max以降は元のコントローラーの記述に合わせてください
            'name_kana' => 'required|string',
            'email' => 'required|email',
            'profile_image' => 'nullable|image',
        ];
    }
}