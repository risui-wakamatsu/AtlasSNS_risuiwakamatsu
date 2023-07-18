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

  <!--検索結果が表示されるコード書く-->
  @if(isset($users)) <!--$usersを受け取ったときに発動-->
  <table>
    @foreach($users as $users)
    <tr>
      <td><img src="{{asset('storage/images'.$users->images)}}" alt="ユーザーアイコン"></td>
      <td>{{$users->username}}</td>
    </tr>
    @endforeach
  </table>
  @endif

</div>



@endsection
