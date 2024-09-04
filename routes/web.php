<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Events\testingEvent;

Route::get('/', function () {
    return view('welcome'); 
}); 

Route::get('chat1', [HomeController::class, 'chat1']);
Route::get('chat2', [HomeController::class, 'chat2']);

Route::post('send_chat1', [HomeController::class, 'send_chat1']);
Route::post('send_chat2', [HomeController::class, 'send_chat2']);
