<?php
// app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function tentang()
    {
        return view('tentang');
    }

    public function petunjuk()
    {
        return view('petunjuk');
    }
}