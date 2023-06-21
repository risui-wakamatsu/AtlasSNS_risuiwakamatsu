<?php

//FormRequest
//Requestファサード継承を利用したバリデーション処理

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() //フォームリクエスト利用が許可されているかどうかを示すメソッド
    {
        return true; //trueにしておかないと権限拒否されてしまう
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() //適用させたいバリデーションのルールを記述
    {
        return [
            //記述方法：['検証する値'=>'検証ルール1 | 検証ルール2',]
            // もしくは、['検証する値'=>['検証ルール1', '検証ルール2'],]
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40|unique:users',
            'password' => 'required|min:8|max:20|regex:/^[a-zA-Z0-9]+$/|confirmed',
            'password_confirmation' => 'required|min:8|max:20|regex:/^[a-zA-Z0-9]+$/|',

            //required:必須項目
            //string:文字列
            //min,max:最小,最大
            //email:メールアドレスか検証
            //unique:テーブル名:指定したテーブルで重複がないか検証
            //regex:正規表現:正規表現にマッチするか検証
            //confirmed:_confirmationに入力されたものと一致する必要がある
        ];
    }

    public function messages() //エラーメッセージ
    {
        return [
            //記述方法：検証する値.検証ルール=>'メッセージ',
            //検証ルールごとに設定が必要
            'username.required' => 'ユーザー名は入力必須項目です。',
            'username.min' => 'ユーザー名は2文字以上12文字以内で入力してください。',
            'username.max' => 'ユーザー名は2文字以上12文字以内で入力してください。',

            'mail.required' => 'メールアドレスは入力必須項目です。',
            'mail.email' => '正しいメールアドレスを入力してください。',
            'mail.min' => 'メールアドレスは5文字以上40文字以内で入力してください。',
            'mail.max' => 'メールアドレスは5文字以上40文字以内で入力してください。',
            'mail.unique' => 'こちらのメールアドレスは登録済みです。',

            'password.required' => 'パスワードは入力必須項です。',
            'password.min' => 'パスワードは8文字以上20文字以内の英数字で入力してください。',
            'password.max' => 'パスワードは8文字以上20文字以内の英数字で入力してください。',
            'password.regex' => 'パスワードは8文字以上20文字以内の英数字で入力してください。',
            'password.confirmed' => 'パスワードが一致していません。'
        ];
    }
}
