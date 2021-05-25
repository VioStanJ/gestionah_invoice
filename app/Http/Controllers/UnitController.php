<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductUnit;
use App\Utility;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $company = Utility::getCompany($request->user());

        $units = ProductUnit::where('company_id','=',$company->id)->where('status','=',1)->get();

        return view('unit.index',compact('units'));
    }

    public function create()
    {
        return view('unit.create');
    }

    public function store(Request $request)
    {
        $company = Utility::getCompany($request->user());

        $unit = ProductUnit::create([
            'code'=>'U-'.$company->id.time(),
            'company_id'=>$company->id,
            'name'=>$request->name,
            'created_by'=>$request->user()->id
        ]);

        if(!isset($unit)){
            return redirect()->back()->withErrors(['Unit not saved :/ !']);
        }

        return redirect('/unit')->with(['Unit Saved :) !']);
    }

    public function edit($id)
    {
        $unit = ProductUnit::find($id);

        return view('unit.edit',compact('unit'));
    }

    public function update(Request $request,$id)
    {
        $unit = ProductUnit::find($id);

        $unit->name = $request->name;
        if(!$unit->save()){
            return redirect()->back()->withErrors(['Update failed :/ !']);
        }

        return redirect()->back()->withInput(['Unit Updated :) ']);
    }

    public function destroy($id)
    {
        $unit = ProductUnit::find($id);

        $unit->status = 0;

        if(!$unit->save()){
            return redirect()->back()->withErrors(['Deleted failed :/ !']);
        }

        return redirect()->back()->withInput(['Unit Deleted :) ']);
    }
}
