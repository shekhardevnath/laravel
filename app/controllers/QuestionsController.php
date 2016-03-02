<?php

class QuestionsController extends BaseController {

	public $restful = true;

	public function __construct() {
		$this->beforeFilter('auth', array('only' => array('create', 'your_questions', 'edit_question', 'update')));
	}

	public function get_index()
	{
		return View::make('questions.index')
		       ->with('title', 'Make It Snappy Q&A - Home')
		       ->with('questions', Question::unsolved());
	}

	public function post_create() {
		$validation = Question::validate(Input::all());

		if($validation->passes()) {
			$question = new Question;

			$question->question = Input::get('question');
			$question->user_id = Auth::user()->id;

			$question->save();

			return Redirect::route('home')->with('message', 'Your question has been posted.');
		}
		else {
			return Redirect::route('home')->withErrors($validation)->withInput();
		}
	}

	public function get_view($id = null) {
		return View::make('questions.view')
		             ->with('title', 'Make It Snappy Q&A - View Question')
		             ->with('question', Question::find($id));
	}

	public function get_your_questions() {
		return View::make('questions.your_questions')
		             ->with('title', 'Make It Snappy Q&Q - Your Questions')
		             ->with('username', Auth::user()->username)
		             ->with('questions', Question::your_questions());
	}

	public function get_edit_question($id = null) {
		$question = Question::find($id);

		$question->solved ? $question->yes = 1 : $question->yes = 0;
		$question->solved ? $question->no = 0 : $question->no = 1;

		if(Auth::user()->id == $question->user_id) {
			return View::make('questions.edit')
					 ->with('title', 'Make It Snappy Q&A - Edit Question')
					 ->with('question', $question);
		}

		else {
			return Redirect::route('your_questions')
			          ->with('message', 'Invalid Operation!');
		}
	}

	public function post_update() {
		$question = Question::find(Input::get('id'));

		if(Auth::user()->id == $question->user_id) {
			$question->solved = Input::get('solved');
			$question->question = Input::get('question');
			$question->save();

			return Redirect::route('your_questions')
						->with('message', 'Question updated');
		}
		else {
			return Redirect::route('your_questions')
						->with('message', 'Invalid Operation');
		}
	}
}