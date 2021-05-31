<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest:customer')->except('logout');
    }

    public function index(Request $request)
    {
        return view('customer.home');
    }
}
