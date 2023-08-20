@extends('layouts.login')

@section('content')
<div class="profile">
  <div class="profile-update">
    {!! Form::open(['url' => ['/profile/{id}/update'],'method=>post']) !!} <!--更新用のURL-->
    {{ Form::label('user name') }}
    {{ Form::text('username','$auth->username',['class'=>'input'])}} <!--追加属性記述する 現在の値出るようにする-->

    {{ Form::label('mail address') }}
    {{ Form::text('mail','$auth->mail',['class'=>'input'])}} <!--追加属性記述する 現在の値出るようにする-->

    {{Form::label('password')}}
    {{ Form::password('password',['class'=>'input']) }} <!--追加属性記述する-->

    {{Form::label('password confirm')}}
    {{ Form::password('confirm',['class'=>'input']) }} <!--追加属性記述する-->

    {{Form::label('bio')}}
    {{ Form::text('bio','$auth->bio',['class'=>'input'])}} <!--追加属性記述する 現在の値出るようにする-->

    {{Form::label('icon image')}}
    {{Form::file('icon',['class'=>'input'])}}

    <button type="button" class="btn btn-danger">更新</button>
  </div>

</div>


@endsection
