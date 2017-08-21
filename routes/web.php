<?php

Route::get('/', 'PagesController@welcome')->name('welcome');
Route::get('/all-projects', 'PagesController@allProjects')->name('all.projects');
Route::get('/all-employers', 'PagesController@allEmployers')->name('all.employers');
Route::get('/all-freelancers', 'PagesController@allFreelancers')->name('all.freelancers');

Auth::routes();

// dashboard
Route::get('/home', 'HomeController@index')->name('home');

// users
Route::put('/{user}/update-user', 'UsersController@update')->name('update.user');
Route::get('/{user}', 'UsersController@show')->name('show.user');
Route::get('/{user}/edit', 'UsersController@edit')->name('edit.user');

//projects
Route::put('/{project}/update-project', 'ProjectsController@update')->name('update.project');
Route::get('/{user}/add-project', 'ProjectsController@create')->name('create.project');
Route::post('/{user}/store-project', 'ProjectsController@store')->name('store.project');
Route::get('/{user}/accepted-projects', 'ProjectsController@acceptedProjects')->name('accepted.projects');
Route::get('/{user}/accepted-projects/{project}', 'ProjectsController@acceptedShow')->name('showAccepted.project');
Route::get('/{user}/accepted-projects/{project}/feedback', 'FeedbackController@create')->name('create.feedback');
Route::post('/{project}/store-feedback', 'FeedbackController@store')->name('store.feedback');
Route::get('/{user}/{project}', 'ProjectsController@show')->name('show.project');
Route::get('/{user}/{project}/edit', 'ProjectsController@edit')->name('edit.project');

//proposals
Route::post('/{user}/{project}/add-proposal', 'ProposalsController@store')->name('store.proposal');
Route::post('/{project}/accept-proposal', 'ProposalsController@acceptProposal')->name('accept.proposal');

//messages
Route::post('/{user}/{project}/send-message', 'MessagesController@store')->name('store.message');
