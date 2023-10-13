<!--更新用のフォーム　ブラウザ表示あり-->

@extends('layouts.login')

@section('content')
<div class="container">
  <div class="update">
    {!! Form::open(['url' => '/profile/update','files' => true]) !!} <!--'files' => true：enctype属性のmultipart/form-data--><!--enctype属性：ファイルを送信する場合に必要になる-->
    @csrf
    {{Form::hidden('id',Auth::user()->id)}}
    <img class="update-icon" src="{{asset('storage/'.Auth::user()->images)}}" alt="アイコン" height="64" width="64">
    <div class="update-form">
      <div class="update-block"> <!--ユーザー名-->
        <label for="name">user name</label>
        <input type="text" name="username" value="{{Auth::user()->username}}"> <!--ログインユーザーの情報をvalueを使って初期値に設定-->
      </div>
      <div class="update-block"> <!--メールアドレス-->
        <label for="mail">mail address</label>
        <input type="email" name="mail" value="{{Auth::user()->mail}}">
      </div>
      <div class="update-block"> <!--パスワード-->
        <label for="pass">password</label>
        <input type="password" name="password" value="">
      </div>
      <div class="update-block"> <!--パスワード確認用-->
        <label for="name">password comfirm</label>
        <input type="password" name="password_confirmation" value="">
      </div>
      <div class="update-block"> <!--自己紹介文（任意）-->
        <label for="name">bio</label>
        <input type="text" name="bio" value="{{Auth::user()->bio}}">
      </div>
      <div class="update-block"> <!--アイコン画像アップロード（任意）-->
        <label for="name">icon image</label>
        <input type="file" name="images">
      </div>
      <input type="submit" class="btn btn-danger"> <!--押下したらデータが更新されるページへ--><!--ログインしているユーザーのidを取得-->
      {{Form::token()}}
      {!! Form::close() !!}
    </div>
  </div>
</div>


@endsection
