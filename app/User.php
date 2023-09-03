<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model; //追加

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'images', 'following_id', 'followed_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() //リレーション(Postテーブルと結合)定義
    {
        return $this->hasMany('App\Post'); //hasMany：1対多の「多」側はhasManyメソッド
        //1人のユーザーに対して複数の投稿ができる
    }

    //フォロー機能　リレーション
    public function following() //このユーザーがフォローしている人を取得
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id')->withTimestamps();
        //(使用するモデル,使用するテーブル,リレーション元のidを入れた中間テーブルのカラム,リレーション先のidを入れた中間テーブルのカラム)
    }

    public function followed() //このユーザーをフォローしている人を取得
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id')->withTimestamps();
        //(使用するモデル,使用するテーブル,リレーション元のidを入れた中間テーブルのカラム,リレーション先のidを入れた中間テーブルのカラム)
    }

    //フォローする
    public function follow(Int $user_id) //INT:変数を正数に
    {
        return $this->following()->attach($user_id); //attach:紐付け　followingのリレーションのuser_id紐付け
    }

    //フォロー解除する
    public function unfollow(INT $user_id) //INT:変数を正数に
    {
        return $this->following()->detach($user_id); //detach:紐付け解除　followingのリレーションのuser_id紐付け解除
    }

    //フォローしているか
    public function isFollowing(INT $user_id) //UsersControllerのisFollowingの引数が送信されて$user_idとして使える
    {
        return (bool) $this->following()->where('followed_id', $user_id)->first(); //first:最初のレコードを取得、単一のレコードを取得する
        //boolean:真偽の値を表す　trueとfalseの2種類しか値にない
        //$this->○○メソッド：このページ内にある○○
        //where：followed_idのカラムの中に$user_idがあったら取得
    }

    //フォローされているか
    public function isFollowed(INT $user_id)
    {
        return (bool) $this->followed()->where('following_id', $user_id)->first(); //first:最初のレコードを返す、単一のレコードを取得する
        //boolean:真偽の値を表す　trueとfalseの2種類しか値にない
        //$this->○○メソッド：このページ内にある○○
        //where：followed_idのカラムの中に$user_idがあったら取得
    }
}
