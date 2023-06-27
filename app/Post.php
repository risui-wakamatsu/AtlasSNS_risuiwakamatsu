<?php //モデル　データベースを利用するときにコントローラー側からのリクエストを精査し実行する

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [ //←記述することで指定したカラムに対してのみcreateやupdateが可能になる
        'post', //postカラムとuser_idのみにcreateやupdate可能
        'user_id'
    ];

    public function user() //リレーション(Userテーブルと結合)定義
    {
        return $this->hasMany('App\User'); //hasMany：1対多の「多」側はhasManyメソッド
        //1人のユーザーに対して投稿を複数登録できる
    }
}
