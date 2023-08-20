<!--ログイン画面-->

@extends('layouts.logout')

@section('content') <!--ここからendまでlogout.bladeの@yield('content')へ-->
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!} <!--URLはログイン後のページではなく、middlewareを通るためにログインするページにする-->

<div class="login_form">
  <p class="welcome">AtlasSNSへようこそ</p>

  <div class="input_form">
    {{ Form::label('e-mail',null,['class'=>'form_name']) }}
    {{ Form::text('mail',null,['class' => 'input']) }}
  </div>
  <div class="input_form">
    {{ Form::label('password',null,['class'=>'form_name']) }}
    {{ Form::password('password',['class' => 'input']) }}
  </div>

  <div class="login_btn">
    <button type="submit" class="btn btn-danger">LOGIN</button>
  </div>

  <p class="register"><a class="register_link" href="/register">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}
</div>

@endsection
