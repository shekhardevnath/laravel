<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', function()
{
	return View::make('hello');
});*/

Route::get('/', array('as'=>'home', 'uses' => 'QuestionsController@get_index'));
Route::get('register', array('as' => 'register', 'uses' => 'UsersController@get_new'));
Route::get('login', array('as'  => 'login', 'uses' => 'UsersController@get_login'));
Route::get('logout', array('as' => 'logout', 'uses' => 'UsersController@get_logout'));
Route::get('question/{id}', array('as' => 'question', 'uses' =>'QuestionsController@get_view'));
Route::get('your-questions', array('as' => 'your_questions', 'uses' => 'QuestionsController@get_your_questions'));
Route::get('edit-question/{id}/edit', array('as' => 'edit_question', 'uses' => 'QuestionsController@get_edit_question'));

Route::post('register', array('before' => 'csrf', 'uses' => 'UsersController@post_create'));
Route::post('login', array('before' => 'csrf', 'uses' => 'UsersController@post_login'));
Route::post('ask', array('before' => 'csrf', 'uses' => 'QuestionsController@post_create'));
Route::post('update', array('brfore' => 'csrf', 'uses' => 'QuestionsController@post_update'));
Route::post('answer', array('before' => 'csrf', 'uses' => 'AnswersController@post_answer'));

Route::get('welcome', function()
{
	return View::make('welcome');
});
