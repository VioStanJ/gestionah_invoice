<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\VerifyEmail;
use App\Models\UserActivation;
use Carbon\Carbon;
use App\Models\User;

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

        $code = $user->id.'-'.time();

        try {
            UserActivation::create([
                'user_id'=>$user->id,
                'code'=>$code,
                'end_at'=>Carbon::now()->add('day',1)
            ]);

            \Mail::to($user->email)->send(new VerifyEmail($user,$code));

        } catch (\Exception $e) {}

        return redirect('/verify/email?email='.$user->email);
    }

    public function verifyCode(Request $request,$code)
    {
        $usc = UserActivation::where('code','=',$code)->get()->last();

        $user = User::find($usc->user_id);

        if(!isset($usc) || !isset($user)){
            return view('auth.activation');
        }

        $user->email_verified_at = Carbon\Carbon::now();
        $user->save();

        return redirect('/login');
    }
}
