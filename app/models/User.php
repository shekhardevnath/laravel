<?php
/*
class User extends Eloquent {

	protected $table = 'users';
	//protected $fillable = array('username', 'password');

	public static $rules = array(
		'username' => 'required|unique:users|alpha_dash|min:4',
		'password' => 'required|alpha_num|between:4,8|confirmed',
		'password_confirmation' => 'required|alpha_num|between:4,8'
	);

	public static function validate($data) {

		return Validator::make($data, static::$rules);
	}
}*/

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	//protected $fillable = array('username', 'password');

	public static $rules = array(
		'username' => 'required|unique:users|alpha_dash|min:4',
		'password' => 'required|alpha_num|between:4,8|confirmed',
		'password_confirmation' => 'required|alpha_num|between:4,8'
	);

	public static function validate($data) {

		return Validator::make($data, static::$rules);
	}

	public function question() {
		return $this->hasMany('Question');
	}

	public function answer() {
		return $this->hasMany('answer');
	}
}