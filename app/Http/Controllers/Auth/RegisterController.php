<?php
//登録画面の処理内容記述

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest; //クラスをuse宣言

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public function __construct()
    //{
    //$this->middleware('guest');
    //}

    public function register(RegisterFormRequest $request)
    {
        //POSTの処理
        //バリデーションを実行するクラス
        if ($request->isMethod('post')) {

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            return redirect('added')->with('username', $username); //第一引数：キー、第二引数：値
            //withメソッドで変数をadded.blade.php(URL:/added)に送信する
            //リダイレクト処理を行った場合は第二引数の$usernameが変数ではなくセッションに保存されるため、added.blade.phpではsessionを使い呼び起こす
        }
    }

    public function registerView()
    {
        //GETの処理
        //registerのページを反映させるクラス
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}
