<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Events\testingEvent;

Route::get('/', function () {
    return view('welcome'); 
}); 


Route::get('test', function () {

    event(new testingEvent('hello from test'));

    return 'done'; 

}); 
