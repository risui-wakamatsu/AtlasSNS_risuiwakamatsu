<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //追加

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //auth認証
        //PostsController.phpを読み込む前にauth機能を実行
    }

    public function index()
    {
        $user = Auth::user(); //ログインしたユーザーの情報を取得する
        $username = Auth::user()->username; //上記で取得したユーザー情報からusernameの情報だけ取得する
        return view('posts.index');
    }

    public function logout()
    {
        return view('auth.login');
    }
}
