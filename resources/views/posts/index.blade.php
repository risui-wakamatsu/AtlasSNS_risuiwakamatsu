<!--http://127.0.0.1:8000/top-->

@extends('layouts.login')

@section('content')

<!--投稿フォーム-->
<div class="container">
  {!! Form::open(['url' => '/top']) !!} <!--登録処理を通る-->
  <div class="form-group">
    {{ Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。']) }}<!--inputタグ-->
    {{Form::image('images/post.png')}} <!--ー画像送信ボタン-->
  </div>
  {{Form::token()}}
  {!! Form::close() !!}
</div>

@foreach ($posts as $post)
<tr>
  <td>{{$post->user->username}}</td>
  <!--user：Post.php(モデル)に定義したメソッド-->
  <!--username：テーブルのカラム-->
  <!--リレーション定義をしたことでpostsテーブルと紐づいたユーザー名が表示される-->
  <td>{{$post->post}}</td>
  <td>{{$post->created_at}}</td>
</tr>
@endforeach

@endsection
