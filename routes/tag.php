<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

Route::prefix('tags')
->controller(TagController::class)
->middleware(['auth'])
->group(function () {

    Route::get('/','index')->name('tags');
    Route::get('/create','create')->name('tags.create');
    Route::post('/','store')->name('tags.store');
    Route::get('/{tag}','edit')->name('tags.edit');
    Route::patch('/{tag}', 'update')->name('tags.update');
    Route::get('/{tag}/delete', 'destroy')->name('tags.delete');

});
