<?php

use Forum\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('/home');
});

Auth::routes(['verify' => true ]);

Route::get('/', 'DiscussionController@index')->name('home');

Route::resource('discussions', 'DiscussionController');

Route::resource('discussions/{discussion}/replies', 'RepliesController');

Route::get('users/notifications', [UsersController::class, 'notifications'])->name('users.notificaions');

Route::post('discussions/{discussion}/replies/{reply}/mark-as-best-reply', 'DiscussionController@reply')->name('discussion.best-reply');