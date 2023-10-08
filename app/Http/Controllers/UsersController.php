<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //追加
use App\Post; //追加
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; //ハッシュ化

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
    public function unfollow(User $user)
    {
        $following = Auth::user(); //Authでusersテーブルからデータ取得(ログインユーザー)
        $is_following = auth()->user()->isFollowing($user->id); //UserモデルのisFollowingメソッドへ
        if ($is_following) { //もしフォローしていれば
            auth()->user()->unfollow($user->id); //userモデルのunfollowメソッドへ
        }
        return back();
    }

    //プロフィール編集機能
    public function updateProfile(Request $request)
    {
        $id = $request->input('id');
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio');
        //$images = $request->input('images');
        $dir = 'images'; //画像が保存されるpublic内のフォルダ名を定義
        $file_name = $request->file('images')->getClientOriginalName();
        $images = $request->file('images')->storeAs('public/' . $dir, $file_name); //storeAs：画像を保存するメソッド シンボリックリンク $dir：保存先のフォルダ $file_name：アップロードされたファイルの名前を取得
        //if文を使って、画像が入っていれば登録、入っていなければその他を登録
        //if ($images) {}
        //ddd($images);
        //画像の保存:storage/app/public
        //画像の表示:public/storage

        User::where('id', $id)->update([
            'username' => $username,
            'mail' => $mail,
            'password' => Hash::make($request->password), //ハッシュ化することでDBに変更した内容がそのまま反映されずに暗号化される
            'bio' => $bio,
            'images' => $images
        ]);

        return redirect('/top');
    }

    public function userProfile($id) //フォロー、フォロワーリストから他ユーザーのプロフィールへ飛ぶ
    {
        $user = User::where('id', $id)->first();
        $post = Post::all();
        //$post = Post::where('user_id', $user_id)->first();
        //ddd($post);
        //ddd($id);
        return view('users.userProfile', ['user' => $user, 'post' => $post]);
    }
}
