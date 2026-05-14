<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\Controller;
use App\Http\Requests\User\ProfileRequest;

class ProfileController extends Controller
{
    public function editPassword()
   {
        return view('user.password_edit');
   }

   public function updatePassword(ProfileRequest $request)
  {

      $user = \App\Models\User::find(1);// 今ログインしているユーザーを取得(一旦強制的に連れてくる)
      

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
