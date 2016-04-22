<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'TemplateController@index');

// Backgrounds
Route::resource('template', 'TemplateController');
Route::post('template/{template}/change_image', ['as' => 'template.show.change_image', 'uses' => 'TemplateController@change_image']);
Route::post('template/{template}/apply_image', ['as' => 'template.show.apply_image', 'uses' => 'TemplateController@apply_image']);

Route::group(['prefix' => '/api/v1'], function () {
    Route::post('templates/apply_image', ['as' => 'api.v1.templates.apply_image', 'uses' => 'api\v1\TemplateController@appy_image']);
});
