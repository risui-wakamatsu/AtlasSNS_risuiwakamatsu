@extends('layouts.login')

@section('content')

<div class="profile-group">
  <img src="{{asset('/storage/'.$user->images)}}" alt="プロフィールアイコン">
  <div class="profile-content">
    <td>name</td>
    <td>{{$user->username}}</td>
    <td>bio</td>
    <td>{{$user->bio}}</td>
    <td>
      @if(auth()->user()->isFollowing($user->id)) <!--もしフォローしている場合は-->
      <form action="{{route('unfollow',$user->id)}}" method="post"> <!--ルーティングのURLを表示させる-->
        @csrf
        <button type="submit" class="btn btn-danger">フォロー解除</button>
        <!--buttonのtypeはsubmitにしないと送信れない　type="button"はただのボタン-->
      </form>
      @else
      <form action="{{route('follow',$user->id)}}" method="post"> <!--ルーティングのURLを表示させる-->
        @csrf
        <button type="submit" class="btn btn-primary">フォローする</button>
      </form>
    </td>
    @endif
  </div>
</div>
@foreach($post as $post) <!--投稿-->
<li class="post_block">
  <figure><img class="post_icon" src="{{asset('/storage/'.$user->images)}}"></figure>
  <div class="post_content">
    <div class="post_name">{{$post->user->username}}</div> <!--リレーション postsテーブルから取得したものを表示させる-->
    <div class="post_date">{{$post->created_at}}</div>
    <div class="post">{{$post->post}}</div>
  </div>
  @endforeach
  @endsection
