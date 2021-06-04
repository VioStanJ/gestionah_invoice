<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInformation;
use App\Models\Proposal;
use App\Models\ProposalProduct;
use App\Utility;
use App\Models\ProductUnit;
use App\Models\category;
use App\Models\Article;
use DB;
use Illuminate\Support\Facades\Crypt;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        $company = \App\Utility::getCompany($request->user());

        $proposals = Proposal::where('company_id', '=',$company->id)->get();

        $status = Proposal::$statues;

        $customer = CustomerInformation::where('company_id', '=',$company->id)->get()->pluck('name', 'customer_code');

        foreach ($proposals as $key => $value) {
            $value->customer = CustomerInformation::where('company_id', '=',$company->id)->where('customer_code','=',$value->customer_code)->get()->first();
        }

        return view('proposal.index',compact(['customer','proposals','status']));
    }

    public function create(Request $request,$customerId)
    {
        $customerId = $customerId;

        $company = \App\Utility::getCompany($request->user());

        $customers = CustomerInformation::where('company_id', '=',$company->id)->get()->pluck('name', 'customer_code');
        $customers->prepend('Select Customer', '');

        $category = category::where('company_id','=',$company->id)->where('status','=',1)->where('type','=',1)->get()->pluck('name', 'code');;
        $category->prepend('Select Category', '');

        $proposal_number = $this->getProposalNumber($request,$company);

        $product_services = Article::where('company_id','=',$company->id)->where('status','=',1)->get()->pluck('name', 'code');
        $product_services->prepend('--', '');

        return view('proposal.create',compact('customerId','customers','category','proposal_number','product_services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'issue_date' => 'required',
            'category_id' => 'required',
            'items' => 'required',
        ]);

        // dd($request->all());
        DB::beginTransaction();

        $company = \App\Utility::getCompany($request->user());

        $proposal                 = new Proposal();
        $proposal->company_id     = $company->id;
        $proposal->code           = $this->getProposalNumber($request,$company);
        $proposal->customer_code  = $request->customer_id;
        $proposal->status         = 0;
        $proposal->issue_date     = $request->issue_date??null;
        $proposal->category_code    = $request->category_id;
        $proposal->discount_apply = isset($request->discount_apply) ? 1 : 0;
        $proposal->created_by     = $request->user()->id;

        if(!$proposal->save()){
            DB::rollBack();
            return redirect()->back()->withErrors(["Fail on save Proposal :/ !"]);
        };

        $products = $request->items;

        for($i = 0; $i < count($products); $i++)
        {
            $proposalProduct              = new ProposalProduct();
            $proposalProduct->proposal_code = $proposal->code;
            $proposalProduct->product_code  = $products[$i]['item'];
            $proposalProduct->quantity    = $products[$i]['quantity'];
            $proposalProduct->tax         = $products[$i]['tax']??0;
            $proposalProduct->discount    = isset($products[$i]['discount']) ? $products[$i]['discount'] : 0;
            $proposalProduct->price       = $products[$i]['price'];
            $proposalProduct->description = $products[$i]['description'];
            $proposalProduct->save();
        }

        DB::commit();

        return redirect()->to('/proposal')->with('success', __('Proposal successfully created.'));
    }

    public function customer(Request $request)
    {
        $customer = CustomerInformation::where('customer_code', '=', $request->id)->first();

        return view('proposal.customer_detail', compact('customer'));
    }

    public function product(Request $request)
    {

        $data['product'] = $product = Article::where('code','=',$request->product_id)->get()->first();

        $data['unit']    = (!empty($product->unit())) ? $product->unit()->name : '';
        // $data['taxRate'] = $taxRate = !empty($product->tax_id) ? $product->taxRate($product->tax_id) : 0;

        // $data['taxes'] = !empty($product->tax_id) ? $product->tax($product->tax_id) : 0;
        $data['taxes'] = 0;

        $salePrice           = $product->ttc;
        $quantity            = 1;
        // $taxPrice            = ($taxRate / 100) * ($salePrice * $quantity);
        $taxPrice            = 0;
        $data['totalAmount'] = ($salePrice * $quantity);

        return json_encode($data);
    }

    public function getProposalNumber($request,$company)
    {
        $latest = Proposal::where('company_id', '=', $company->id)->count();
        $id = 0;
        if($latest == 0)
        {
            $id = 1;
        }else{
            $id = $latest->id + 1;
        }

        return "PROP" .$company->id.'-'. sprintf("%05d", $id);
    }

    public function show(Request $request,$code)
    {
        $code     = Crypt::decrypt($code);
        $proposal = Proposal::where('code','=',$code)->get()->first();

        $company = \App\Utility::getCompany($request->user());

        $customer = CustomerInformation::where('company_id', '=',$company->id)->where('customer_code','=',$proposal->customer_code)->get()->first();

        $items = $proposal->items;

        $status   = Proposal::$statues;

        return view('proposal.view',compact(['proposal','customer','items','status']));
    }
}
