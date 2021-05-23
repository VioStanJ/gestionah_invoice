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
        return view('category.create');
    }
}
