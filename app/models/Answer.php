<?php

class Answer extends Eloquent {
	protected $table = 'answers';

	public static $rules = array(
		'answer' => 'required|min:2|max:255'
		);

	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}

	public function question() {
		return $this->belongsTo('Question');
	}

	public function user() {
		return $this->belongsTo('User');
	}
}
