<?php

//FormRequest
//Requestファサード継承を利用したバリデーション処理

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\User; //追加
use Illuminate\Support\Facades\Auth;



class UpdateFormRequest extends FormRequest

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
    public function rules() //プロフィール更新用
    {
        return [
            //記述方法：['検証する値'=>'検証ルール1 | 検証ルール2',]
            // もしくは、['検証する値'=>['検証ルール1', '検証ルール2'],]
            'username' => 'required|string|min:2|max:12',
            'mail' => ['required', 'string', 'email', 'min:5', 'max:40', Rule::unique('users')->ignore(Auth::id())], //自分自身のメールアドレスは同じでOK,unique:users入れてしまうと指定カラムなのかで重複しないルールになってしまう
            //Ruleファサードとignoreメソッド：uniqueを適用するが、Auth::id()（ログインしているユーザー）のメールアドレスはOKにする
            'password' => 'min:8|max:20|regex:/^[a-zA-Z0-9]+$/|confirmed',
            'password_confirmation' => 'min:8|max:20|regex:/^[a-zA-Z0-9]+$/|',
            'bio' => 'max:150|nullable', //nullable:任意（nullでもOK）
            'images' => 'mimes:jpeg,png,bmp,gif,svg|nullable', //アップロードできる拡張子指定

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

            'password.required' => 'パスワードは入力必須項目です。',
            'password.min' => 'パスワードは8文字以上20文字以内の英数字で入力してください。',
            'password.max' => 'パスワードは8文字以上20文字以内の英数字で入力してください。',
            'password.regex' => 'パスワードは8文字以上20文字以内の英数字で入力してください。',
            'password.confirmed' => 'パスワードが一致していません。',

            'password_confirmation.required' => '確認用パスワードは入力必須項目です。',
            'password_confirmation.min' => '確認用パスワードは8文字以上20文字以内の英数字で入力してください。',
            'password_confirmation.max' => '確認用パスワードは8文字以上20文字以内の英数字で入力してください。',
            'password_confirmation.regex' => '確認用パスワードは8文字以上20文字以内の英数字で入力してください。',

            'bio.max' => '紹介文は150文字以内で入力してください。',

            'images.mimes' => '画像ファイル以外のアップロードは不可です。'
        ];
    }
}
