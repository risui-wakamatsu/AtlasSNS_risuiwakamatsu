<!--ユーザー登録画面-->

@extends('layouts.logout')

@section('content')

<!--バリデーション　エラーメッセージ表示-->
@if($errors->any())
<div class="register-error">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

{!! Form::open(['url' => '/register']) !!} <!--ルーティング(web.php)に記載されている登録完了ページのページのクラスへ-->

<div class="register_form">
  <h2 class="welcome">新規ユーザー登録</h2>

  <div class="input_form">
    {{ Form::label('ユーザー名') }}
    {{ Form::text('username',null,['class' => 'input']) }}
  </div>

  <div class="input_form">
    {{ Form::label('メールアドレス') }}
    {{ Form::text('mail',null,['class' => 'input']) }}
  </div>
  <div class="input_form">
    {{ Form::label('パスワード') }}
    {{ Form::text('password',null,['class' => 'input']) }}
  </div>

  <div class="input_form">
    {{ Form::label('パスワード確認') }}
    {{ Form::text('password_confirmation',null,['class' => 'input']) }}
  </div>

  <div class="register_btn">
    <button type="submit" class="btn btn-danger">REGISTER</button>
  </div>

  <p class="register"><a class="register_link" href="/login">ログイン画面へ戻る</a></p>

  {!! Form::close() !!}
</div>


@endsection
