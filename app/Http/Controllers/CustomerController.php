<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
     function cus(){
        $customer = Customer::all();
        return view ('customer',compact('customer'));
    }

    function store(Request $request){
        $customers_name = $request->input('customers_name');
        $address = $request->input('address');
        $data = new Customer();
        $data->customers_name = $customers_name;
        $data->address = $address;
        $data->save();
        //return redirect()->route('contact.index');
        return redirect()->route('customer.cus')->with('SUCCES!','Data Anda Tersimpan');


    }
}
