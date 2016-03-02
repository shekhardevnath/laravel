@extends('layouts.default')

@section('content')
  <h1>{{ ucfirst($question->user->username) }} asks:</h1>
  <p>{{ e($question->question) }}</p>

  <div id='post-answer'>
  	<h2>Answer this Question</h2>
  	@if(!Auth::check())
  		Please login to post an answer this question.
  	@else
  		@if($errors->has())
  			<ul id='form-errors'>
  				{{ $errors->first('answer', '<li>:message</li>') }}
  			</ul>
  		@endif  		
  		{{ Form::open(array('url'=>'answer', 'methosd'=>'POST')) }}
  		{{ Form::token() }}
  		{{ Form::hidden('question_id', $question->id) }}
  		<p>
  			{{ Form::label('answer', 'Answer') }}
  			{{ Form::text('answer', Input::old('answer')) }}
  			{{ Form::submit('Post Answer') }}
  		</p>
  		{{ Form::close() }}
  	@endif
  </div><!-- end post-answer -->
@stop