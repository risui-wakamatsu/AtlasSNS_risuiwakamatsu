<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //追加

class UsersController extends Controller
{
    public function profile()
    {
        return view('users.profile');
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword'); //検索フォームから送られてきたkeyword
        if (!empty($keyword)) {
            $users = User::where('username', 'like', '%' . $keyword . '%')->get();
            //検索フォームに入力があればあいまい検索で検索結果出力
        } else {
            $users = User::all();
            //検索フォーム空ならusersテーブルのレコード全て出力
        }

        return view('users.search', ['users' => $users]); //usersテーブルから取得したデータを$usersに代入しusers.searchで画面表示させる
    }
}
