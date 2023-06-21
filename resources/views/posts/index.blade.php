<!--http://127.0.0.1:8000/top-->

@extends('layouts.login')

@section('content')

<!--投稿フォーム-->
<div class="container">
  {!! Form::open(['url' => '/top']) !!} <!--formタグ-->
  <div class="form-group">
    {{ Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。']) }}<!--inputタグ-->
    {{Form::image('images/post.png')}} <!--ー画像送信ボタン-->
  </div>
  {{Form::token()}}
  {!! Form::close() !!}
</div>

@endsection
