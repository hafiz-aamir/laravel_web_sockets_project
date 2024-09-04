<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\testingEvent;


class HomeController extends Controller
{
    
    public function chat1(){


        return view('chat1');

    }


    public function chat2(){


        return view('chat2');

    }



    public function send_chat1(){
        
        event(new testingEvent('Hello User 1'));
    }


    public function send_chat2(){
        
        event(new testingEvent('Hello User 2'));
    }
    

}
