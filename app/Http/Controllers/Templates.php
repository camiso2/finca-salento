<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Templates extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function contact(){
        return view('contact');
    }
    public function services(){
        return view('services');
    }
    public function map(){
        return view('map');
    }
}
