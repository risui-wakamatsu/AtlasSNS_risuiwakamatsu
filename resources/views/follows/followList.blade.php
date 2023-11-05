@extends('layouts.login')

@section('content')
<div class="follow_list">
  <p class="follow_title">Follow List</p>
  <ul>
    @foreach($follows as $follows) <!--FollowsControllerのfollowListメソッドの$follows-->
    <li class="follow_icon">
      <a href="/users/{{$follows->id}}/profile"><img src="{{asset('storage/'.$follows->images)}}" alt="フォローアイコン" height="64" width="64"></a>
      <!--$followsからuserテーブルのimagesを表示-->
    </li>
    @endforeach
  </ul>
</div>

@foreach($posts as $post) <!--投稿-->
<li class="post_block">
  <img class="post_icon" src="{{asset('storage/'.$post->user->images)}}" height="64" width="64">
  <!--$postからuserテーブルのimagesを表示-->
  <div class="post_content">
    <div class="post_name">{{$post->user->username}}</div> <!--リレーション postsテーブルから取得したものを表示させる-->
    <div class="post_date">{{$post->created_at}}</div>
    <div class="post">{{$post->post}}</div>
  </div>
</li>
@endforeach

@endsection
