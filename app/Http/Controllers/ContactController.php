<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   
   
   
   
    function con(){
        $contact = Contact::all();
        return view ('contact',compact('contact'));
    }

    function store(Request $request){
        $nama_lengkap = $request->input('nama_lengkap');
        $email = $request->input('email');
        $pesan = $request->input('pesan');
        $data = new Contact();
        $data->nama_lengkap = $nama_lengkap;
        $data->email = $email;
        $data->pesan = $pesan;
        $data->save();
        //return redirect()->route('contact.index');
        return redirect()->route('contact.index')->with('SUCCES!','Data Anda Tersimpan');


    }
}
