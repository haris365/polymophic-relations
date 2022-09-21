<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

Route::prefix('videos')
->controller(VideoController::class)
->middleware(['auth'])
->group(function () {

    Route::get('/','index')->name('videos');
    Route::get('/create','create')->name('videos.create');
    Route::post('/','store')->name('videos.store');
    Route::get('/{video}','edit')->name('videos.edit');
    Route::patch('/{video}', 'update')->name('videos.update');
    Route::get('/{video}/delete', 'destroy')->name('videos.delete');

});



