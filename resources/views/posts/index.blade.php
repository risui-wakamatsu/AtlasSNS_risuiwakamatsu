<!--http://127.0.0.1:8000/top-->

@extends('layouts.login')

@section('content')

<!--投稿フォーム-->
<div class="container">
  {!! Form::open(['url' => '/post/create']) !!} <!--登録処理を通る-->
  <div class="post_form">
    {{ Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。']) }}<!--inputタグ-->
    <!--<input type="text" name="newPost" class="form-control" placeholder="投稿内容を入力してください。">-->
  </div>
  <!--{{Form::image('images/post.png')}}--> <!--ー画像送信ボタン-->
  <div class="post_btn">
    <input class="post_img" type="image" src="images/post.png" alt="投稿" width="50" height="50">
  </div>
  {{Form::token()}}
  {!! Form::close() !!}
</div>

<div class="post-container">
  @foreach($posts as $post) <!--投稿-->
  <li class="post_block">
    <figure><img src="images/icon1.png"></figure>
    <div class="post_content">
      <div class="post_name">{{$post->user->username}}</div> <!--リレーション postsテーブルから取得したものを表示させる-->
      <div class="post">{{$post->post}}</div>
      <div class="post_date">{{$post->created_at}}</div>
    </div>

    @if(Auth::user()->id==$post->user_id) <!--idとuser_idがあっている時のみ編集と削除の機能が使える-->

    <!--更新機能-->
    <div class="button_block">
      <div class="content">
        <a class="js-modal-open button" href="" post="{{$post->post}}" post_id="{{$post->id}}"><img src="./images/edit.png" alt="編集"></a>
      </div>

      <!--削除機能-->
      <div class="content">
        <a class="button" href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
          <img src="./images/trash.png" alt="削除1" width="100%" height="100%">
          <img src="./images/trash-h.png" alt="削除2" width="100%" height="100%">
        </a>
      </div>
    </div>
  </li>
</div>
<!--ファサードを使い画像を反映させる-->
<!--onclickで削除のモーダル-->

<!--モーダルの中身-->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="/post/update" method="post">
      <textarea name="upPost" class="modal_post"></textarea>
      <input type="hidden" name="id" class="modal_id" value="">
      <input type="image" name="submit" src="./images/edit.png" alt="編集">
      {{csrf_field()}}
    </form>
    <a class="js-modal-close" href=""></a>
  </div>
</div>

@endif

@endforeach
</div>

@endsection
