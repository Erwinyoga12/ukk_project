<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    function keg(){
        return view('kegiatan');
    }

    function home(){
        return view('home');
    }

    function pres(){
        return view ('prestasi');
    }

    function gin(){
        return view ('gin');
    }

    function eskul(){
        return view ('eskul');
    }


    function rkpPramuka(){
        return view ('rkpPramuka');
    }
    

    function gotapramuka(){
        return view ('gotapramuka');
    }
}


