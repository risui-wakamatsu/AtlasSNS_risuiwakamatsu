<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //追加
use App\Follow; //追加
use App\Post; //追加　Postモデルを使用するため
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        $follows = User::all();
        $following_id = auth()->user()->following()->pluck('followed_id'); //フォローしているユーザーのidを取得
        $posts = Post::with('user')->whereIn('user_id', $following_id)->get();
        //ddd($follows);
        return view('follows.followList', ['follows' => $follows, 'posts' => $posts]);
    }
    public function followerList()
    {
        $followers = User::all();
        $followed_id = auth()->user()->followed()->pluck('following_id'); //自分をフォローしているユーザーのidを取得
        $posts = Post::with('user')->whereIn('user_id', $followed_id)->get();
        //ddd($follows);
        return view('follows.followerList', ['followers' => $followers, 'posts' => $posts]);
    }
}
