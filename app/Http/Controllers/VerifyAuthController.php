<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\VerifyEmail;
use App\Models\UserActivation;
use Carbon\Carbon;

class VerifyAuthController extends Controller
{
    public function verify(Request $request)
    {
        $email = $request->input('email');

        return view('auth.verify',compact('email'));
    }

    public function resend(Request $request)
    {
        $request->validate([
            'email'=>'required'
        ]);

        $user = User::where('email','=',$request->email)->get()->first();

        if(!isset($user)){
            return redirect()->back()->withErrors(['E-mail not found :/ !']);
        }

        // dd($user);

        $code = $user->id.'-'.time();
        try {
            UserActivation::create([
                'user_id'=>$user->id,
                'code'=>$code,
                'end_at'=>Carbon::now()->add('day',1)
            ]);

            \Mail::to($user->email)->send(new VerifyEmail($user,$code));

        } catch (\Exception $e) {
        }

        return redirect('/verify/email?email='.$user->email);
    }
}
