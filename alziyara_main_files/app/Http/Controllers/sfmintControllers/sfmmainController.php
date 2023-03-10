<?php

namespace App\Http\Controllers\sfmintControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class sfmmainController extends Controller
{
    public function index(){

        return view('sfmviews.myviews.home');
        
    }

    public function about(){
        
        return view('sfmviews.myviews.about');
        
    }

    public function comingsoon(){
        
        return view('sfmviews.myviews.coming');
        
    }

    public function fundraising(){
        
        return view('sfmviews.myviews.fundraising');
        
    }

    public function gallery(){
        
        return view('sfmviews.myviews.gallery');
        
    }

    public function game(){
        
        return view('sfmviews.myviews.game');
        
    }

    public function shop(){
        
        return view('sfmviews.myviews.shop');
        
    }

    public function videos(){
        
        return view('sfmviews.myviews.videos');
        
    }

    public function tshirtcustom(){

        return view('sfmviews.myviews.customizer');

    }
}
