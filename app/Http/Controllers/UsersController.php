<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //追加
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function profile()
    {
        return view('users.profile');
    }
    public function search(Request $request)
    {
        $user = Auth::user();

        $keyword = $request->input('keyword'); //検索フォームから送られてきたkeyword
        if (!empty($keyword)) {
            $users = User::where('username', 'like', '%' . $keyword . '%')->get();
            //検索フォームに入力があればあいまい検索で検索結果出力
        } else {
            $users = User::all();
            //検索フォーム空ならusersテーブルのレコード全て出力
        }

        return view('users.search', ['users' => $users,  'keyword' => $keyword]); //usersテーブルから取得したデータをそれぞれ変数に代入しusers.searchで画面表示させる
        //あいまい検索した結果(keyword)を検索ワードに表示させる
    }

    //フォロー機能
    public function follow(User $user) //$user→followedの中身に入る
    {
        //ddd($user);
        $following = Auth::user(); //Authでusersテーブルからデータ取得
        $is_following = auth()->user()->isFollowing($user->id); //isFollowing:ユーザーが特定のユーザーをフォロー中か返す関数
        //ddd($is_following);
        if (!$is_following) { //もしフォローしていなければ
            auth()->user()->follow($user->id); //フォローする
            //この時のfollowはUserモデルのfollowメソッドへ
        }
        return back();
    }

    //フォロー解除
    //エラーは出ていないがレコードが消えてない
    public function unfollow(User $user)
    {
        $following = Auth::user(); //Authでusersテーブルからデータ取得(ログインユーザー)
        $is_following = auth()->user()->isFollowing($user->id); //UserモデルのisFollowingメソッドへ
        if ($is_following) { //もしフォローしていれば
            auth()->user()->unfollow($user->id); //userモデルのunfollowメソッドへ
        }
        return back();
    }

    //プロフィール更新機能
    public function update()
    {
        $user = Auth::user();
    }
}
