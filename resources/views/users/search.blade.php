@extends('layouts.login')

@section('content')

<!--検索フォーム-->
{!! Form::open(['url' => '/']) !!}
{{ Form::search('text', null, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザー名']) }}
{{Form::image('images/search.png')}}
{{Form::token()}}
{!! Form::close() !!}

@endsection
