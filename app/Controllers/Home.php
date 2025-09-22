<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Default home page
     */
    public function index(): string
    {
        return view('template');
    }

    /**
     * About page
     */
    public function about(): string
    {
        return view('about');
    }

    /**
     * Contact page
     */
    public function contact(): string
    {
        return view('contact');
    }
}
