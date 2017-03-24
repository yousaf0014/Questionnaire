<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' =>['web']],function(){
	Route::get('/home', 'HomeController@index');
	Route::get('/Questionnaire','QuestionnaireController@index');
	Route::get('/Questionnaire/create','QuestionnaireController@create');
	Route::get('/Questionnaire/{questionnaire}','QuestionnaireController@show');
	Route::get('/Questionnaire/{questionnaire}/edit','QuestionnaireController@edit');
	Route::get('/Questionnaire/active/{questionnaire}/{active}','QuestionnaireController@active');
	Route::post('/Questionnaire','QuestionnaireController@store');
	Route::put('/Questionnaire/update/{questionnaire}','QuestionnaireController@update');
	Route::delete('/Questionnaire/{questionnaire}','QuestionnaireController@delete');


	Route::get('/Questions/{questionnaire}','QuestionsController@index');
	Route::get('/Questions/create/{questionnaire}','QuestionsController@create');
	Route::get('/Questions/edit/{question}','QuestionsController@edit');
	Route::get('/Questions/{questionnaire}/{question}','QuestionsController@show');
	Route::post('/Questions/{questionnaireID}','QuestionsController@store');
	Route::put('/Questions/update/{question}','QuestionsController@update');
	Route::delete('/Questions/{question}','QuestionsController@delete');
	
});
