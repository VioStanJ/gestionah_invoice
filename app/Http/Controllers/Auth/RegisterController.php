<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserAdress;
use App\Models\Country;
use App\Models\Company;
use App\Models\CompanyAdress;
use App\Models\UserCompany;
use App\Models\CompanySetting;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use App\Mail\VerifyEmail;
use Carbon\Carbon;
use App\Models\UserActivation;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        $request->validate([
            'company_name'=>'required',
            'company_email'=>'required',
            'country'=>'required|exists:countries,id',
            'name'=>'required',
            'phone'=>'',
            'city'=>'',
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed',
        ]);

        DB::beginTransaction();

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>\bcrypt($request->password),
        ]);

        if(!$user){
            DB::rollback();
            return \redirect()->back()->withErrors(['Error on Save User !']);
        }

        $company = Company::create([
            'name'=>$request->company_name,
            'email'=>$request->company_email,
            'description'=>$request->company_name,
            'created_by'=>$user->id,
        ]);

        if(!$company){
            DB::rollback();
            return \redirect()->back()->withErrors(['Error on Save Company !']);
        }

        CompanyAdress::create([
            'company_id'=>$company->id,
            'country_id'=>$request->country,
            'city'=>$request->city,
        ]);

        UserAdress::create([
            'user_id'=>$user->id,
            'country_id'=>$request->country,
            'city'=>$request->city,
            'adress'=>'',
        ]);

        $valid = UserCompany::create([
            'user_id'=>$user->id,
            'company_id'=>$company->id,
            'type_code'=>'OWN',
        ]);

        if(!$valid){
            DB::rollback();
            return \redirect()->back()->withErrors(['Error on Save !']);
        }

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

        DB::commit();

        return redirect('/verify/email?email='.$user->email);
    }

    public function show()
    {
        $countries = Country::all();

        return view('auth.register',compact(['countries']));
    }
}
