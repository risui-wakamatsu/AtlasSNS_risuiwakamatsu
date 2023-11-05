@extends('layouts.login')

@section('content')

<div class="profile-group">
  <img src="{{asset('/storage/'.$user->images)}}" alt="プロフィールアイコン" height="64" width="64">
  <div class="profile-content">
    <div class="content_name">
      <p class="item1">name</p>
      <p class="item">{{$user->username}}</p>
    </div>
    <div class="content_bio">
      <p class="item1">bio</p> <!--&emsp;-->
      <p class="item">{{$user->bio}}</p>
    </div>
    <td>
      @if(auth()->user()->isFollowing($user->id)) <!--もしフォローしている場合は-->
      <form action="{{route('unfollow',$user->id)}}" method="post"> <!--ルーティングのURLを表示させる-->
        @csrf
        <button type="submit" class="btn btn-danger profile_btn">フォロー解除</button>
        <!--buttonのtypeはsubmitにしないと送信れない　type="button"はただのボタン-->
      </form>
      @else
      <form action="{{route('follow',$user->id)}}" method="post"> <!--ルーティングのURLを表示させる-->
        @csrf
        <button type="submit" class="btn btn-primary profile_btn">フォローする</button>
      </form>
    </td>
    @endif
  </div>
</div>
@foreach($post as $post) <!--投稿-->
<li class="post_block">
  <figure><img class="post_icon" src="{{asset('/storage/'.$user->images)}}" height="64" width="64"></figure>
  <div class="post_content">
    <div class="post_name">{{$post->user->username}}</div> <!--リレーション postsテーブルから取得したものを表示させる-->
    <div class="post_date">{{$post->created_at}}</div>
    <div class="post">{{$post->post}}</div>
  </div>
  @endforeach
  @endsection
