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
        'username', 'mail', 'password',
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

    public function follow() //フォロワー→フォローへ
    {
        return $this->BelongsToMany('App/User', 'follows', 'following_id', 'followed_id');
    }

    public function follower() //フォロー→フォロワーへ
    {
        return $this->belongsToMany('App/User', 'follows', 'followed_id', 'following_id');
    }
    //第一引数：使用するモデル
    //第二引数：使用するテーブル
    //第三引数：リレーションを定義しているモデルの外部キー
    //第四引数：結合するモデルの外部キー
}
