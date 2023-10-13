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

        User::where('id', $id)->update([
            'username' => $username,
            'mail' => $mail,
            'password' => Hash::make($request->password), //ハッシュ化することでDBに変更した内容がそのまま反映されずに暗号化される
            'bio' => $bio,
        ]);

        if ($request->file('images')) { //fileでimagesを取得していたら画像の保存・更新を実行
            $file_name = $request->file('images')->getClientOriginalName(); //$file_name：アップロードされたファイルの名前を取得
            $images = $request->file('images')->storeAs('', $file_name, 'public'); //storeAs：画像を保存するメソッド シンボリックリンク
            //引数(1.フォルダ名,2.ファイルネーム,3.ディスク名) 1にpublicをしてしてしまうと保存された画像のパスがpublic/~~~になるため、1は空欄で3にpublicを指定する そうすれば1が空欄でもstorage/app/publicに画像が保存される
            //if文を使って、画像が入っていれば登録、入っていなければその他を登録
            //画像の保存:storage/app/public
            //画像の表示:public/storage シンボリックリンク

            User::where('id', $id)->update([
                'images' => $images,
            ]);
        }

        return redirect('/top');
    }

    public function userProfile($id) //フォロー、フォロワーリストから他ユーザーのプロフィールへ飛ぶ
    {
        $user = User::where('id', $id)->first();
        $post = Post::where('user_id', $id)->get();
        return view('users.userProfile', ['user' => $user, 'post' => $post]);
    }
}
