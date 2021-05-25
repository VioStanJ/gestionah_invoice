<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Utility;
use App\Models\Article;
use App\Models\ProductUnit;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $company = Utility::getCompany($request->user());

        $categories = category::where('company_id','=',$company->id)->where('status','=',1)->where('type','=',0)->get()->pluck('name', 'id');

        $products = [];

        return view('product.index',compact('products','categories'));
    }

    public function create(Request $request)
    {
        $company = Utility::getCompany($request->user());

        $units = ProductUnit::where('company_id','=',$company->id)->where('status','=',1)->get()->pluck('name', 'id');

        $categories = category::where('company_id','=',$company->id)->where('status','=',1)->where('type','=',0)->get()->pluck('name', 'id');

        return view('product.create',compact('units','categories'));
    }
}
