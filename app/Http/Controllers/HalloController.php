<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalloController extends Controller
{
    public function index(){
        return '<h1>Hallo dari controller</h1>';
    }
}
