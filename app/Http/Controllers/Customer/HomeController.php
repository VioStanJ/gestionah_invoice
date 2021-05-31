<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        return view('customer.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('customer/login')->with('success', 'Logged Out');
    }
}
