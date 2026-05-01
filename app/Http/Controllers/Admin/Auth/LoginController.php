<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('auth:admin')->only('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login'); // admin の方を指定
    }

    /**
     * ログアウト処理（オーバーライド）
     */
    public function logout(Request $request)
    {
        // 1. 管理者としてログアウトを実行
        $this->guard()->logout();

        // 2. セッションを無効化（セキュリティのため）
        $request->session()->invalidate();

        // 3. セッションのトークンを再生成
        $request->session()->regenerateToken();

        // 4. 【ここが重要！】ログアウト後の飛ばし先を管理者ログイン画面に！
        return redirect()->route('admin.show.login');
    }
}
