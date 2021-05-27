<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerInformation;
use App\Models\Country;
use App\Utility;
use DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $company = Utility::getCompany($request->user());

        $customers = CustomerInformation::where('company_id','=',$company->id)->where('status','=',1)->get();

        return view('customer.index',compact('customers'));
    }

    public function create()
    {
        $countries = Country::all()->pluck('name','id');

        return view('customer.create',compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|email'
        ]);

        $company = Utility::getCompany($request->user());

        $customer = Customer::where('email','=',$request->email)->get()->first();

        DB::beginTransaction();

        if(!isset($customer)){
            $customer = new Customer();
            $customer->email = $request->email;
            // $customer->password = bcrypt('CUS'.$company->id.$this->keygen(12));
            $customer->password = bcrypt('pass0011'); // For test
            $customer->code = "CUS-".$company->id.time();

            if(!$customer->save()){
                return redirect()->back()->withErrors(['New Customer failed on saved :/ !']);
            }
        }

        $info = new CustomerInformation();

        $info->company_id      = $company->id;
        $info->name            = $request->name;
        $info->phone           = $request->phone;
        $info->created_by      = $request->user()->id;
        $info->customer_code   = $customer->code;

        $info->billing_name    = $request->billing_name;
        $info->billing_country = $request->billing_country;
        $info->billing_state   = $request->billing_state;
        $info->billing_city    = $request->billing_city;
        $info->billing_phone   = $request->billing_phone;
        $info->billing_zip     = $request->billing_zip;
        $info->billing_address = $request->billing_address;

        $info->shipping_name    = $request->shipping_name;
        $info->shipping_country = $request->shipping_country;
        $info->shipping_state   = $request->shipping_state;
        $info->shipping_city    = $request->shipping_city;
        $info->shipping_phone   = $request->shipping_phone;
        $info->shipping_zip     = $request->shipping_zip;
        $info->shipping_address = $request->shipping_address;

        if(!$info->save()){
            DB::rollBack();
            return redirect()->back()->withErrors(['Failed to save Customer :/ !']);
        }

        //Send email

        DB::commit();

        return redirect('customer')->with(['Customer Saved :) !']);
    }

    public function show(Request $request,$code)
    {

    }

    public function edit(Request $request,$code)
    {
        $customer = Customer::where('code','=',$code)->get()->first();

        $company = Utility::getCompany($request->user());

        $info = CustomerInformation::where('customer_code','=',$code)->where('company_id','=',$company->id)->get()->first();

        $read = false;

        if($customer->email_verified_at != null || $customer->email_verified_at != ''){
            $read = true;
        }

        return view('customer.edit',compact(['customer','info','read']));
    }

    public function update(Request $request,$code)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|email'
        ]);

        $company = Utility::getCompany($request->user());

        $customer = Customer::where('code','=',$code)->get()->first();

        DB::beginTransaction();

        if(!isset($customer)){
            return redirect()->back()->withErrors(['Customer not found :/ !']);
        }

        $send = false;

        if($customer->email != $request->email){

            $customer->email = $request->email;

            if($customer->email_verified_at != null || $customer->email_verified_at != ''){
                $send = true;
            }

            if(!$customer->save()){
                return redirect()->back()->withErrors(['Customer failed on edit :/ !']);
            }
        }

        $info = CustomerInformation::where('customer_code','=',$code)->where('company_id','=',$company->id)->get()->first();

        if(!isset($info)){
            $info = new CustomerInformation();
            $info->company_id      = $company->id;
            $info->created_by      = $request->user()->id;
            $info->customer_code   = $customer->code;
        }

        $info->name            = $request->name;
        $info->phone           = $request->phone;

        $info->billing_name    = $request->billing_name;
        $info->billing_country = $request->billing_country;
        $info->billing_state   = $request->billing_state;
        $info->billing_city    = $request->billing_city;
        $info->billing_phone   = $request->billing_phone;
        $info->billing_zip     = $request->billing_zip;
        $info->billing_address = $request->billing_address;

        $info->shipping_name    = $request->shipping_name;
        $info->shipping_country = $request->shipping_country;
        $info->shipping_state   = $request->shipping_state;
        $info->shipping_city    = $request->shipping_city;
        $info->shipping_phone   = $request->shipping_phone;
        $info->shipping_zip     = $request->shipping_zip;
        $info->shipping_address = $request->shipping_address;

        if(!$info->save()){
            DB::rollBack();
            return redirect()->back()->withErrors(['Failed to edit Customer :/ !']);
        }

        DB::commit();

        return redirect('customer')->with(['Customer Edited :) !']);
    }

    public function destroy(Request $request,$code)
    {
        $company = Utility::getCompany($request->user());

        $info = CustomerInformation::where('customer_code','=',$code)->where('company_id','=',$company->id)->get()->first();

        $info->status = 0;

        $info->save();

        return redirect()->back()->with(['Customer deleted !']);
    }

    function keygen($length=10)
    {
        $key = '';
        list($usec, $sec) = explode(' ', microtime());
        mt_srand((float) $sec + ((float) $usec * 100000));

        $inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));

        for($i=0; $i<$length; $i++)
        {
            $key .= $inputs[mt_rand(0,61)];
        }
        return $key;
    }
}
