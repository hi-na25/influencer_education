<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editPassword()
   {
        return view('user.password_edit');
   }

   public function updatePassword(Request $request)
  {

      $user = \App\Models\User::find(1);// 今ログインしているユーザーを取得(一旦強制的に連れてくる)

      // ① バリデーション（入力チェック）
      $request->validate([
          'current_password' => 'required',
          'new_password' => 'required|string|min:8|confirmed',
      ], [
          'current_password.required' => '旧パスワードを入力してください。',
          'new_password.required' => '新パスワードを入力してください。',
          'new_password.min' => '新パスワードは8文字以上で入力してください。',
          'new_password.confirmed' => '新パスワードと確認用が一致しません。',
      ]);


      // ② 旧パスワードが合っているかチェック
      if (!Hash::check($request->current_password, $user->password)) {
          return back()->withErrors(['current_password' => '旧パスワードが正しくありません。']);
        }

      // ③ 新しいパスワードを暗号化して保存
      $user->password = Hash::make($request->new_password);
      $user->save();

      // 完了したら画面を戻す
      return back()->with('status', 'パスワードを変更しました！');
  }
}
