<?php

class UsersController extends BaseController {

	public $restful = true;

	public function get_new(){

		return View::make('users.new')
		             ->with('title', 'Make It Snappy Q&A - Register');
	}

	public function post_create(){

		$validation = User::validate(Input::all());

		if($validation->passes()) {

			$user = new User;

			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));

			$user->save();

			$userInfo = User::whereusername(Input::get('username'))->first();
			Auth::login($userInfo);

            /*
			User::create(array(
				'username' => Input::get('username'),
				'password' => Hash::make(Input::get('password'))
				)); */

			return Redirect::route('home')->with('message', 'Thanks for registering! You are now logged in.');
		}
		else
			return Redirect::route('register')->withErrors($validation)->withInput();
	}

	public function get_login() {

		return View::make('users.login')
		             ->with('title', 'Make It Snappy Q&A - Login');
	}

	public function post_login() {

		$user = array('username' => Input::get('username'), 'password' => Input::get('password'));

	    if(Auth::attempt($user)) {
		    return Redirect::route('home')->with('message', 'You are logged in!');
	    }
	    else {
	    	return Redirect::route('login')
	    	                 ->with('message', 'Your username/password combination was incorrect.')
	    	                 ->withInput();
	    }	    
	}

	public function get_logout() {

		if(Auth::check()) {
			Auth::logout();
			return Redirect::Route('login')->with('message', 'You are now logged out.');
		}
		else {
			return Redirect::Route('home');
		}
	}
}