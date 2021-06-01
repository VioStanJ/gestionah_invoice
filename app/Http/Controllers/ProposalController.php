<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInformation;
use App\Models\Proposal;
use App\Utility;

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
}
