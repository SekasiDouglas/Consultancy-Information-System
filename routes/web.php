<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return App\Leave::find(1)->users;

});
// Route::resource('contacts', 'ContactController')->middleware('check-permission:CEO');
Route::resource('contacts', 'ContactController');
Route::resource('opportunities', 'OpportunityController');
Route::post('opportunities/changeStatus', 'OpportunityController@changeStatus');

Route::resource('leaves', 'leavesController');
Route::resource('tasks', 'TasksController');
Route::resource('documents', 'DocumentsController');
Route::get('/projects/create/{id}/', 'ProjectsController@createProject')->name('projects.create');
Route::post('/projects/store', 'ProjectsController@store')->name('projects.store');
Route::get('/projects/index', 'ProjectsController@index')->name('projects');
Route::get('/users', 'UsersController@index')->name('users');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users/store', 'UsersController@store')->name('users.store');
Route::get('/users/admin/{id}', 'UsersController@admin')->name('users.admin');
Route::get('/users/not-admin/{id}', 'UsersController@not_admin')->name('users.not.admin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
