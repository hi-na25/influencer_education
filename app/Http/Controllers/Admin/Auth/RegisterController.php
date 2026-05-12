<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // 送られてきたメアドの中に、少しでも「あ」などの全角が含まれているか
        // またはブラウザが勝手に変換した「xn--」が含まれているかをチェック
        if (isset($data['email']) && (preg_match('/[^\x01-\x7E]/u', $data['email']) || str_contains($data['email'], 'xn--'))) {
            $validator = Validator::make([], []); // 空のバリデータ作成
            $validator->errors()->add('email', 'メールアドレスに全角文字は使用できません。');
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'kana'     => ['required', 'string', 'max:255', 'regex:/^[ァ-ヶー]+$/u'],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:admins',
                // さらに正規表現で「xn--」を拒否する
                'regex:/^[^x]*+(?:x(?!n--)[^x]*+)*+$/i'
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'     => '名前を入力してください。',
            'kana.required'     => '名前（カナ）を入力してください。',
            'kana.regex'        => '名前（カナ）は全角カタカナで入力してください。',
            'email.required'    => 'メールアドレスを入力してください。',
            'email.email'       => '正しいメールアドレス形式で入力してください。',
            'email.unique'      => 'このメールアドレスは既に登録されています。',
            'email.regex'       => 'メールアドレスに全角文字や特殊な変換は使用できません。',
            'password.required' => 'パスワードを入力してください。',
            'password.min'      => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return Admin
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'kana' => $data['kana'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showRegistrationForm()
    {
        return view('admin.auth.register'); // admin の方を指定
    }

    // ログアウト
    protected function loggedOut(\Illuminate\Http\Request $request)
    {
        return redirect()->route('admin.login');
    }

    // 強制的に戻す
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw (new \Illuminate\Validation\ValidationException($validator))
            ->errorBag($this->errorBag())
            ->redirectTo(route('admin.show.register'));
    }
}
