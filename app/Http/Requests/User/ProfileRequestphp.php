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

    /**
     * ② コントローラーに書いていたルールをここに移す
     */
    public function rules()
    {
        return [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}