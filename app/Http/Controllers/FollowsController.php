<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //追加
use App\Follow; //追加

class FollowsController extends Controller
{
    //
    public function followList()
    {
        return view('follows.followList');
    }
    public function followerList()
    {
        return view('follows.followerList');
    }
}
