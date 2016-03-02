<?php

class AnswersController extends BaseController {
	public $restful = true;

	public function __construct() {
		$this->beforeFilter('auth', array('only' => array('answer')));
	}

	public function post_answer() {
		$question_id = Input::get('question_id');
		$validation  = Answer::validate(Input::all());

		if($validation->passes()){
			$answer = new Answer;

			$answer->answer      = Input::get('answer');
			$answer->user_id     = Auth::user()->id;
			$answer->question_id = $question_id;

			$answer->save();

			return Redirect::route('question', $question_id)
							 ->with('message', 'Your answer has been posted');
		}
		else {
			return Redirect::route('question', $question_id)						     
						     ->withErrors($validation)
						     ->withInput();
		}
		
	}
}