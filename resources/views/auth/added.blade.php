<!--登録完了画面-->

@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="added">
    <p class="added_name">{{session('username')}}さん<br>ようこそ！AtlasSNSへ！</p> <!--sessionを使って一時的にユーザー名の表示-->
    <p>ユーザー登録が完了しました。<br>早速ログインをしてみましょう。</p>

    <div class="added_btn">
      <a href="/login"><button type="button" class="btn btn-danger w-auto">ログイン画面へ</button></a>
    </div>
  </div>
</div>

@endsection
