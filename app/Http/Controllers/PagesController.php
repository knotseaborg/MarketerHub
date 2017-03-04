<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //Action for routing Welcome page
    public function getHome(){
        return view('pages.welcome');
    }

    //Will shift to a seperate controller
    public function getBlog(){
        return view('pages.blog');
    }

    public function getExplore(){
        return view('pages.explore');
    }

    
}
