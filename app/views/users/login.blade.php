@extends('layouts.default')

@section('content')

  <h1>Login</h1>

  {{ Form::open(array('url' => 'login', 'method' => 'POST')) }}
  {{ Form::token() }}

  <p>
  	{{ Form::label('username', 'Username:') }} <br>
  	{{ Form::text('username', Input::old('username')) }}
  </p>
  <p>
  	{{ Form::label('password', 'Password:') }} <br>
  	{{ Form::password('password') }}
  </p>

  {{ Form::submit('Login') }}
  {{ Form::close() }}

@stop