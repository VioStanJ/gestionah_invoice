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

        $products = Article::where('company_id','=',$company->id)->where('status','=',1)->get();

        return view('product.index',compact('products','categories'));
    }

    public function create(Request $request)
    {
        $company = Utility::getCompany($request->user());

        $units = ProductUnit::where('company_id','=',$company->id)->where('status','=',1)->get()->pluck('name', 'id');

        $categories = category::where('company_id','=',$company->id)->where('status','=',1)->where('type','=',0)->get()->pluck('name', 'id');

        return view('product.create',compact('units','categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'ttc'=>'required',
            'price'=>'required',
            'unit_id'=>'required',
            'category_id'=>'required',
            'type'=>'required'
        ]);

        $company = Utility::getCompany($request->user());

        $category = category::find($request->category_id);

        $unit = ProductUnit::find($request->unit_id);

        $article = new Article();

        $article->code = 'A-'.$company->company.time();
        $article->sku = $request->sku ;
        $article->name = $request->name ;
        $article->price = $request->price ;
        $article->ttc = $request->ttc ;
        $article->company_id = $company->id;
        $article->is_service = $request->type;
        $article->unit_code = $unit->code;

        if(isset($category)){
            $article->category_code = $category->code;
        }
        $article->description = $request->description;
        $article->created_by = $request->user()->id;
        $article->on_invoice = 1;

        if($request->hasFile('image')){
            $store = '/storage/root/cmp-'.$company->id.'/articles';
            Utility::mkdir($store);
            $image = $request->file('image');
            $img_name = $company->id.'-'.time().'.'.$image->getClientOriginalExtension();
            $desti = public_path($store);
            $article->image = '/storage/root/cmp-'.$company->id.'/articles/'.$img_name;
        }else{
            $article->image = $request->type==0?'/storage/static/product.png':'/storage/static/service.png';
        }

        if(!$article->save()){
            return redirect()->back()->withErrors(['Product failed :/ !']);
        }

        if($request->hasFile('image')){
            $image->move($desti,$img_name);
        }

        return redirect('/product-service')->with(['Product/Service Saved :) !']);
    }
}
