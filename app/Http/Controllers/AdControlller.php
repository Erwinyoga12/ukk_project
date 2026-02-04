<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdControlller extends Controller
{
     public function dash()
    {
        return view('index');
    }
}
