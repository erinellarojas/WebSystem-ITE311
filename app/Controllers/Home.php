<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('template');
    }

    public function about(): string
    {
        return view('about');
    }

    public function contact(): string
    {
        return view('contact');
    }

    public function testDB()
    {
        try {
            $db = \Config\Database::connect();
            if($db->connID){
                echo "✅ Database connected successfully!";
            } else {
                echo "❌ Failed to connect to database.";
            }
        } catch (\Exception $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    }
}
