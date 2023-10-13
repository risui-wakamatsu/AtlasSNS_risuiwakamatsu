@extends('layouts.login')

@section('content')
<div class="follow-list">
  <p class="follow-title">Follow List</p>
  <ul>
    @foreach($follows as $follows) <!--FollowsControllerのfollowListメソッドの$follows-->
    <li class="follow-icon">
      <a href="/users/{{$follows->id}}/profile"><img src="{{asset('storage/'.$follows->images)}}" alt="フォローアイコン"></a>
      <!--$followsからuserテーブルのimagesを表示-->
    </li>
    @endforeach
  </ul>
</div>

@foreach($posts as $post) <!--投稿-->
<li class="post_block">
  <img class="post_icon" src="{{asset('storage/'.$post->user->images)}}">
  <!--$postからuserテーブルのimagesを表示-->
  <div class="post_content">
    <div class="post_name">{{$post->user->username}}</div> <!--リレーション postsテーブルから取得したものを表示させる-->
    <div class="post_date">{{$post->created_at}}</div>
    <div class="post">{{$post->post}}</div>
  </div>
</li>
@endforeach

@endsection
