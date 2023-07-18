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
        return $this->belongsTo('App\User'); //belongsTo：1対多の「1」側はbelongsToメソッド
        //1人で複数の投稿ができる
    }
}
