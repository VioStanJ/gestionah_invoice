<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $company = \App\Utility::getCompany($request->user());

        $categories = category::where('company_id','=',$company->id)->get();

        return view('dashboard.category',compact('categories'));
    }

    public function create(Request $request)
    {
        $types = category::$categoryType;

        return view('category.create',compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'color' => 'required',
        ]);

        $company = \App\Utility::getCompany($request->user());

        $category = new category();
        $category->code = 'K-'.$company->id.time();
        $category->company_id = $company->id;
        $category->name = $request->name;
        $category->color = $request->color;
        $category->type = $request->type;
        $category->created_by = $request->user()->id;

        if(!$category->save()){
            return redirect()->back()->withErrors(['Create Category failed :/ !']);
        }

        return redirect()->back()->withInput(['Created with Success :) !']);
    }
}
