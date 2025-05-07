<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('about'); // Pastikan view-nya ada di resources/views/about.blade.php
    }
}
