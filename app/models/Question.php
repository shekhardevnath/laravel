<?php

class Question extends Eloquent {
	protected $table = 'questions';

	public static $rules = array(

		'question' => 'required|min:10|max:255',
		'solved'   => 'in:0,1'
		);

	public static function validate($data) {

		return Validator::make($data, static::$rules);
	}

	public function user() {
		return $this->belongsTo('User');
	}

	public function answer() {
		return $this->hasMany('Answer');
	}

	public static function unsolved() {
		return $questions =  static::where('solved', '=', 0)->orderby('id', 'DESC')->paginate(3);

	}

	public static function your_questions() {
		return $questions = static::where('user_id', '=', Auth::user()->id)->orderby('id', 'DESC')->paginate(3);
	}
}