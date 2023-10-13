<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //追加
use App\Post; //追加　Postモデルを使用するため
use App\User; //追加

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //auth認証
        //PostsController.phpを読み込む前にauth機能を実行
    }

    public function index() ///トップページに遷移した時の処理
    {
        $user = Auth::user(); //ログインしたユーザーの情報を取得する
        $username = Auth::user()->username; //上記で取得したユーザー情報からusernameの情報だけ取得する
        //$posts = Post::get(); //Postモデル(テーブル)からレコード情報を全て取得
        $following_id = auth()->user()->following()->pluck('followed_id'); //フォローしているユーザーのidを取得
        $posts = Post::with('user')->whereIn('user_id', $following_id)->get(); //判定したいテーブル名・カラム名,判定したいテーブル名・カラム名の値として期待されるもの
        return view('posts.index', ['posts' => $posts, 'user' => $user]); //postsテーブルから取得したデータを$postsに代入しposts.indexで画面表示させる
    }

    public function postCreate(Request $request) //ブラウザに表示されない登録処理だけを行うメソッド
    {
        $post = $request->input('newPost'); //送られてきたパラメータがPOST送信として$requestに渡される
        $user_id = Auth::user()->id;
        Post::create([
            'post' => $post,
            'user_id' => $user_id
            //postsテーブルのpostとuser_idを変数に当てはめて投稿を登録
        ]);
        return redirect('/top'); //投稿画面にリダイレクト
    }

    public function updatePost($id)
    {
        $post = Post::where('id', $id)->first();
        //where句で条件に引数の$idを設定
        return view('posts.updatePost', ['post' => $post]); //postsテーブルから取得したデータを$postに代入しposts.updatePostで画面表示させる
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        //name属性がid、upPostで指定されているフォームの値を別々の変数で取得
        Post::where('id', $id)->update([ //postsテーブルのidカラムから持ってきたid変数と一致するレコードを選択
            'post' => $up_post
            //レコードのpostカラムを->update()で$up_post変数の値に変更
        ]);
        return redirect('/top');
    }

    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }

    public function logout()
    {
        return view('auth.login');
    }
}
