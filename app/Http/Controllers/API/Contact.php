<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Contact extends Controller
{

    public function getData(){
        $data = DB::table('contacts')->get();
        return response()->json($data);
    }
}
