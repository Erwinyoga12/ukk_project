<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function con()
    {
        $contact = Contact::all();
        return view('contak', compact('contact')); // ← 'contak' bukan 'contact'
    }

    function store(Request $request)
    {
        $data = new Contact();
        $data->nama_lengkap = $request->input('nama_lengkap');
        $data->email        = $request->input('email');
        $data->pesan        = $request->input('pesan');
        $data->save();

        return redirect()->route('contact.index')->with('success', 'Data Anda Tersimpan!'); // ← key harus 'success' lowercase
    }
} 