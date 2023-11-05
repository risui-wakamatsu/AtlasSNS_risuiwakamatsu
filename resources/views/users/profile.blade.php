<!--更新用のフォーム　ブラウザ表示あり-->

@extends('layouts.login')

@section('content')
<div class="container">
  <div class="update">
    {!! Form::open(['url' => '/profile/update','files' => true]) !!} <!--'files' => true：enctype属性のmultipart/form-data--><!--enctype属性：ファイルを送信する場合に必要になる-->
    @csrf
    {{Form::hidden('id',Auth::user()->id)}}
    <img class="update_icon" src="{{asset('storage/'.Auth::user()->images)}}" alt="アイコン" height="64" width="64">
    <div class="update_form">
      <div class="update_block"> <!--ユーザー名-->
        <label class="profile_label" for="name">user name</label>
        <input class="profile_box" type="text" name="username" value="{{Auth::user()->username}}"> <!--ログインユーザーの情報をvalueを使って初期値に設定-->
      </div>
      <div class="update_block"> <!--メールアドレス-->
        <label class="profile_label" for="mail">mail address</label>
        <input class="profile_box" ype="email" name="mail" value="{{Auth::user()->mail}}">
      </div>
      <div class="update_block"> <!--パスワード-->
        <label class="profile_label" for="pass">password</label>
        <input class="profile_box" type="password" name="password" value="">
      </div>
      <div class="update_block"> <!--パスワード確認用-->
        <label class="profile_label" for="name">password comfirm</label>
        <input class="profile_box" type="password" name="password_confirmation" value="">
      </div>
      <div class="update_block"> <!--自己紹介文（任意）-->
        <label class="profile_label" for="name">bio</label>
        <input class="profile_box" type="text" name="bio" value="{{Auth::user()->bio}}">
      </div>
      <div class="update_block"> <!--アイコン画像アップロード（任意）-->
        <label class="profile_label" for="name">icon image</label>
        <input class="icon_box" type="file" name="images">
      </div>
      <input type="submit" class="btn btn-danger update_btn"> <!--押下したらデータが更新されるページへ--><!--ログインしているユーザーのidを取得-->
      {{Form::token()}}
      {!! Form::close() !!}
    </div>
  </div>
</div>


@endsection
