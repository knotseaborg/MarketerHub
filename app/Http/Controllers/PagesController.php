<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //Action for routing Welcome page
    public function getHome(){
        return view('pages.welcome');
    }

    //Action for routing About page
    public function getAbout(){
        return view('pages.about');
    }

    public function getContact(){
        return view('pages.contact');
    }

    
}
