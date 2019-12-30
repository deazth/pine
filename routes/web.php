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

Route::get('/', 'SampleController@index')->name('index');



Route::group(['middleware' => ['admin']], function () {
  Route::get('/home', 'SampleController@home')->name('home');
  Route::get('/wijet', 'SampleController@wijjet')->name('wijjet');
  Route::get('/graf', 'SampleController@geraf')->name('geraf');
});

Route::get( '/task/request','TaskController@showTaskRequest')->name('task.showrequest');
Route::get( '/task/request/new','TaskController@showTaskRequestNew')->name('task.newrequest');
Route::get( '/task/list','TaskController@showTaskList')->name('task.showlist');
<<<<<<< HEAD
Route::get( '/task/open','TaskController@showTaskOpen')->name('task.showopen');

Route::get( '/user/skill/','UserSkillController@index')->name('userskill.index');
=======
Route::get( '/task/open','TaskController@showTaskOpen')->name('task.showopen'); //Advertisement
  
>>>>>>> a9a5223b8588bda7e3c70dd5beac9753cbbdb930
