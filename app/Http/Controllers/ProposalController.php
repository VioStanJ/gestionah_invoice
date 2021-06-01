<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInformation;
use App\Models\Proposal;
use App\Utility;
use App\Models\ProductUnit;
use App\Models\category;
use App\Models\Article;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        $company = \App\Utility::getCompany($request->user());

        $proposals = Proposal::where('company_id', '=',$company->id)->get();

        $status = Proposal::$statues;

        $customer = CustomerInformation::where('company_id', '=',$company->id)->get()->pluck('name', 'customer_code');

        return view('proposal.index',compact(['customer','proposals','status']));
    }

    public function create(Request $request,$customerId)
    {
        $customerId = $customerId;

        $company = \App\Utility::getCompany($request->user());

        $customers = CustomerInformation::where('company_id', '=',$company->id)->get()->pluck('name', 'customer_code');

        $category = category::where('company_id','=',$company->id)->where('status','=',1)->where('type','=',1)->get()->pluck('name', 'code');;

        $proposal_number = $this->getProposalNumber($request,$company);

        $product_services = Article::where('company_id','=',$company->id)->where('status','=',1)->get()->pluck('name', 'code');

        return view('proposal.create',compact('customerId','customers','category','proposal_number','product_services'));
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
}
