@extends('layouts.default')

@section('content')
	<h1>{{ ucfirst($username) }} Asks:</h1>

	@if(count($questions))
		@foreach($questions as $question)
			<ul>
				<li>
					{{ Str::limit(e($question->question), 35) }} -
					{{ HTML::LinkRoute('edit_question', 'Edit', $question->id) }}
					{{ HTML::linkRoute('question', 'View', $question->id) }}
				</li> 

			</ul>
		@endforeach
		{{ $questions->links() }}
	@else
		<h2>You have not asked any question yet.</h2>
	@endif
@stop