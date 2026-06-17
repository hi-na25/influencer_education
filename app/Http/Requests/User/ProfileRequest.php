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
            // 💡 今回追加するプロフィールのルール（コンマで繋げて一緒に書きます）
            'name' => 'required|string|max:255', // ※max以降は元のコントローラーの記述に合わせてください
            'name_kana' => 'required|string',
            'email' => 'required|email',
            'profile_image' => 'nullable|image',
        ];
    }

    public function messages(): array
    {
        return [
            // 💡 空白で登録しようとしたときに出す日本語のメッセージを設定
            'name.required'      => 'ユーザーネームの入力は必須です',
            'name_kana.required' => 'カナの入力は必須です',
            'email.required'     => 'メールアドレスの入力は必須です',
        ];
    }
}