<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyAuthController extends Controller
{
    public function verify(Request $request)
    {
        return view('auth.verify');
    }

    public function resend(Request $request)
    {

    }
}
