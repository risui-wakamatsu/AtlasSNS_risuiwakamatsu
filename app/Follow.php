<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model  //中間テーブルにあたるテーブル
{
    protected $fillable = [
        'following_id', 'followed_id'
    ];
}
