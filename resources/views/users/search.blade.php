<!--検索-->

@extends('layouts.login')

@section('content')

<!--検索フォーム-->
<div class="container">
  <form action="/search" method="post">
    @csrf
    <input type="search" name="keyword" class="form" placeholder="ユーザー名">
    <button type="submit" class="btn"><img src="./images/search.png" alt="検索"></button>
  </form>

  <!--検索ワード-->
  @if(!empty($keyword))
  <p>検索ワード：{{$keyword}}</p>
  @endif

  <!--検索結果が表示されるコード書く-->
  @if(isset($users)) <!--$usersを受け取ったときに発動-->
  <table>
    @foreach($users as $users)
    <tr>
      <!--<td><img src="{{asset('storage/images'.$users->images)}}" alt="ユーザーアイコン"></td>-->
      <td><img src="{{asset('images/'.$users->images)}}" alt="ユーザーアイコン"></td> <!--修正　usersテーブルのimagesカラムに画像のパスがある場合はこれでアイコン表示できる-->
      <!--asset pathの設定のため-->
      <td>{{$users->username}}</td>
      <td>{{$users->id}}</td>

      <td>
        <form action="{{route('unfollow',$users->id)}}" method="post"> <!--ルーティングのURLを表示させる-->
          @csrf
          <button type="submit" class="btn btn-danger">フォロー解除</button>
          <!--buttonのtypeはsubmitにしないと送信れない　type="button"はただのボタン-->
        </form>
        <form action="{{route('follow',$users->id)}}" method="post"> <!--ルーティングのURLを表示させる-->
          @csrf
          <button type="submit" class="btn btn-primary">フォローする</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
  @endif

</div>



@endsection
