<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::prefix('posts')
->controller(PostController::class)
->middleware(['auth'])
->group(function () {

    Route::get('/','index')->name('posts');
    Route::get('/create','create')->name('posts.create');
    Route::post('/','store')->name('posts.store');
    Route::get('/{post}','edit')->name('posts.edit');
    Route::patch('/{post}', 'update')->name('posts.update');
    Route::get('/{post}/delete', 'destroy')->name('posts.delete');

    Route::
    controller(CommentController::class)
    ->middleware(['auth'])
    ->group(function () {

        // Route::get('/','index')->name('comments');
        // Route::get('/create','create')->name('comments.create');
        Route::post('/{model}/comment','store')->name('comments.store');
        // Route::get('/{video}','edit')->name('comments.edit');
        // Route::patch('/{video}', 'update')->name('comments.update');
        // Route::get('/{video}/delete', 'destroy')->name('comments.delete');

    });

});



