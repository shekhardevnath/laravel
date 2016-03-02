@extends('layouts.default')

@section('content')
	<h1>Edit Question:</h1>
	{{ Form::open(array('url' => 'update', 'method' => 'POST')) }}
	{{ Form::token() }}
	{{ Form::hidden('id', $question->id) }}
	<p> 
		{{ Form::label('question', 'Question:') }}
		{{ Form::text('question', $question->question) }}
	</p>	
	<p>
		{{ Form::label('solved', 'Solved:') }}		
		{{ Form::radio('solved', '1', $question->yes) }}
		{{ Form::label('yes', 'Yes') }}		
		{{ Form::radio('solved', '0', $question->no) }}
		{{ Form::label('no', 'No:') }}
	</p>
	<p>
		{{ Form::submit('Update') }}
	</p>
	{{ Form::close() }}
@stop