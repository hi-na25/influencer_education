<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\Controller;
use App\Http\Requests\User\ProfileRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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

  // 1. プロフィール編集画面を表示する
  public function edit()
  {
      $user = \App\Models\User::find(1); // 今ログインしているユーザーの情報を取得
      return view('user.profile_edit', compact('user'));
  }

  // 2. プロフィール情報を更新する
  public function update(Request $request)
  {
      $user = \App\Models\User::find(1);

      // バリデーション（必要に応じて調整してください）
      $request->validate([
          'name' => 'required|string|max:255',
          'name_kana' => 'required|string|max:255',
          'email' => 'required|email|unique:users,email,' . $user->id,
          'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像の制限
      ]);

      // 名前などの基本情報を更新
      $user->name = $request->name;
      $user->name_kana = $request->name_kana;
      $user->email = $request->email;

      // 画像がアップロードされた場合の処理
      if ($request->hasFile('profile_image')) {
          // 古い画像があれば削除する（任意）
          if ($user->profile_image) {
              Storage::disk('public')->delete($user->profile_image);
          }
        
          // 画像を保存し、そのパスをDBに記録
          if ($request->hasFile('profile_image')) {
              // 1. 画像を images/profile フォルダに profile.png という名前で保存
              $path = $request->file('profile_image')->storeAs('images/profile', 'profile.png', 'public');
    
               // 2. DBには「images/profile/profile.png」という文字列を保存する
               $user->profile_image = $path;
           }
      }

      $user->save(); // データベースに保存

      return redirect()->route('profile.edit')->with('success', 'プロフィールを更新しました！');
  }
}
