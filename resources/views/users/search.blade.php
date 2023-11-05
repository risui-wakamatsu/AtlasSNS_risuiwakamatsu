<!--検索-->

@extends('layouts.login')

@section('content')

<!--検索フォーム-->
<div class="search_block">
  <form action="/search" class="search" method="post">
    @csrf
    <input type="search" name="keyword" class="search-form" placeholder="ユーザー名">
    <input type="image" class="search_img" src="./images/search.png" alt="検索" width="40" height="40">
    <!--検索ワード-->
    @if(!empty($keyword))
    <p class="search-word">検索ワード：{{$keyword}}</p>
    @endif
  </form>
</div>

<!--検索結果が表示されるコード書く-->
<div class="search_user">
  @if(isset($users)) <!--$usersを受け取ったときに発動-->
  <table>
    @foreach($users as $users)
    <tr>
      <!--<td><img src="{{asset('storage/images'.$users->images)}}" alt="ユーザーアイコン"></td>-->
      <td><img src="{{asset('storage/'.$users->images)}}" alt="ユーザーアイコン" height="64" width="64"></td> <!--修正　usersテーブルのimagesカラムに画像のパスがある場合はこれでアイコン表示できる-->
      <!--asset pathの設定のため-->
      <td>{{$users->username}}</td>
      <!--<td>{{$users->id}}</td>-->

      <td>
        @if(auth()->user()->isFollowing($users->id)) <!--もしフォローしている場合は-->
        <form action="{{route('unfollow',$users->id)}}" method="post"> <!--ルーティングのURLを表示させる-->
          @csrf
          <button type="submit" class="btn btn-danger">フォロー解除</button>
          <!--buttonのtypeはsubmitにしないと送信れない　type="button"はただのボタン-->
        </form>
        @else
        <form action="{{route('follow',$users->id)}}" method="post"> <!--ルーティングのURLを表示させる-->
          @csrf
          <button type="submit" class="btn btn-primary">フォローする</button>
        </form>
      </td>
      @endif
    </tr>
    @endforeach
  </table>
  @endif

</div>

@endsection
