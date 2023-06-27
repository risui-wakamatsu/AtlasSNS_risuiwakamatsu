<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //追加
use App\Post; //追加　Postモデルを使用するため

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //auth認証
        //PostsController.phpを読み込む前にauth機能を実行
    }

    public function indexName()
    {
        $user = Auth::user(); //ログインしたユーザーの情報を取得する
        $username = Auth::user()->username; //上記で取得したユーザー情報からusernameの情報だけ取得する
        return view('posts.index');
    }

    public function indexPost()
    {
        $posts = Post::get(); //Postモデル(テーブル)からレコード情報を取得
        return view('posts.index', ['posts' => $posts]);
        //取得したデータをposts.indexで画面表示させる
    }

    public function logout()
    {
        return view('auth.login');
    }

    public function postsCreate(Request $request) //ブラウザに表示されない登録処理だけを行うメソッド
    {
        $post = $request->input('newPost'); //送られてきたパラメータが$requestに渡される
        $user_id = Auth::user()->user_id;
        Post::create([
            'post' => $post,
            'user_id' => $user_id
            //postsテーブルのpostとuser_idを変数に当てはめて投稿を登録
        ]);
        return redirect('index'); //投稿画面にリダイレクト
    }
}
