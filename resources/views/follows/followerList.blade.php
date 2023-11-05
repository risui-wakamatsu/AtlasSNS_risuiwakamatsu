@extends('layouts.login')

@section('content')
<div class="follow-list">
  <p class="follow-title">Follower List</p>
  <ul>
    @foreach($followers as $followers) <!--FollowsControllerのfollowListメソッドの$follows-->
    <li class="follow-icon">
      <a href="/users/{{$followers->id}}/profile"><img src="{{asset('/storage/'.$followers->images)}}" alt="フォローアイコン" height="64" width="64"></a>
    </li>
    @endforeach
  </ul>
</div>

@foreach($posts as $post) <!--投稿-->
<li class="post_block">
  <img class="post_icon" src="{{asset('storage/'.$post->user->images)}}" height="64" width="64">
  <div class="post_content">
    <div class="post_name">{{$post->user->username}}</div> <!--リレーション postsテーブルから取得したものを表示させる-->
    <div class="post_date">{{$post->created_at}}</div>
    <div class="post">{{$post->post}}</div>

  </div>
</li>
@endforeach

@endsection
