@extends('layouts.default')

@section('content')
  <div id='ask'>

  	@if(Auth::check())

  	  @if($errors->has())

  	    <ul id='form-errors'>
  	    	{{ $errors->first('question', '<li>:message</li>') }}
  	    </ul>

  	  @endif

  	  {{ Form::open(array('url' => 'ask', 'method' => 'POST')) }}
  	  {{ Form::token() }}

  	  <p>
  	  	{{ Form::label('question', 'Question') }}
  	  	{{ Form::text('question', Input::old('question')) }}
  	  	{{ Form::submit('Ask a Question') }}
  	  </p>

  	  {{ Form::close() }}

    @else
      <p>Please login to ask or answer questions.</p>
  	@endif

    <div 'questions'>
      <h2>Unsolved questions</h2>

      @if(!count($questions))
        <p>No questions have been asked.</p>
      @else
        <ul>
          @foreach($questions as $question)
            <li>
              {{ HTML::linkRoute('question', Str::limit($question->question, 35), $question->id) }} 
              by {{ ucfirst($question->user->username) }}               
            </li>
          @endforeach
        </ul>
        {{ $questions->links() }}
      @endif
    </div>

  </div><!-- end ask -->
@stop
