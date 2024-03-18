<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\TweetController;


//es fehlt noch die methode get delete update
Route::get('/tweets', [TweetController::class, 'index']);
Route::get('/tweets/{tweet}', [TweetController::class, 'show']);
Route::post('/tweets', [TweetController::class, 'store']);
Route::put('/tweets/{tweet}', [TweetController::class, 'update']);
Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy']);

