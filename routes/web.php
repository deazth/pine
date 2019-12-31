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
  Route::get('/datable', 'SampleController@datable')->name('datable');
  Route::get('/profile', 'UserController@showProfile')->name('user.profile');

  //Task
  Route::get( '/task/request','TaskController@showTaskRequest')->name('task.showrequest');
  Route::get( '/task/request/new','TaskController@showTaskRequestNew')->name('task.newrequest');
  Route::post( '/task/request/new','TaskController@showTaskRequestNew')->name('task.newrequest');
  Route::post( '/task/request/submit','TaskController@submitTaskRequest')->name('task.submitrequest');
  Route::post( '/task/request/view','TaskController@viewTaskRequest')->name('task.viewrequest');
  Route::post( '/task/request/view/propose/reject','TaskController@proposeReject')->name('task.proposedreject');
  Route::post( '/task/request/view/propose/accept','TaskController@proposeAccept')->name('task.proposedaccept');
  Route::post( '/task/request/view/cancel/reject','TaskController@cancellationReject')->name('task.cancellationreject');
  Route::post( '/task/request/view/cancel/approve','TaskController@cancellationApprove')->name('task.cancellationapprove');
  // Route::get( '/task/request/view','TaskController@viewTaskRequest')->name('task.viewrequest');
  Route::get('/task/request/getskill', 'TaskController@taskRequestGetSkill')->name('task.getskill');
  Route::get( '/task/list','TaskController@showTaskList')->name('task.showlist');
  Route::get( '/task/pending','TaskController@showTaskPending')->name('task.showpending');
  Route::get( '/task/open','TaskController@showTaskOpen')->name('task.showopen'); //Advertisement
  Route::get( '/task/assigneeComplete','TaskController@assigneeComplete')->name('task.assigneeComplete'); 
  Route::post( '/task/apply','TaskController@applyForAds')->name('task.apply'); //Advertisement

  Route::get( '/user/skill/','UserSkillController@index')->name('userskill.index');
  Route::get( '/user/skill/create','UserSkillController@create')->name('userskill.create');
  Route::post( '/user/skill/store','UserSkillController@store')->name('userskill.store');
  Route::post( '/user/skill/destroy','UserSkillController@destroy')->name('userskill.destroy');
});

// so-called API
Route::get( '/user/image','UserController@getStaffImage')->name('user.image');
