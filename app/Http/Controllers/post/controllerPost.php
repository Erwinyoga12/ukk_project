<?php

namespace App\Http\Controllers\post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class controllerPost extends Controller
{
    public function inde(){
        $slt = "Selamat Datang";
        $abc = ['soleh'=>$slt];
        return view('post', $abc);
    }
}
