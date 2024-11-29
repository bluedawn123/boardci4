<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // return view('home');
        return render('home');
    }
    public function about(): string
    {
        return render('about');
    }
  
}
