<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = [];

        return view('customer.index',compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }
}
