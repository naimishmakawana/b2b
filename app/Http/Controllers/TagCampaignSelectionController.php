<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomerCampaign;
use App\B2BCustomer;
use App\CampaignsProducts;
use DB;
use App\NFCTag;

class TagCampaignSelectionController extends Controller
{
    public function index()
    {
        $CustomerId = $_GET['id'];

        $B2BCustomer = B2BCustomer::where('CustomerId',$CustomerId)->first();

        $B2BCustomerCampaigns = B2BCustomerCampaign::select("B2BCustomer.NameOfOrganization","B2BCustomerCampaign.*",DB::raw("IF((Select count(*) from NFCTag where CampaignId = B2BCustomerCampaign.CampaignId and CampaignLevel1TerritoryId IS NULL and CampaignLevel2TerritoryId IS NULL)=0,0,1) as IsNFCTagFoundINCmp"),
            DB::raw("IF((Select count(*) from NFCTag where CampaignId = B2BCustomerCampaign.CampaignId and (CampaignLevel1TerritoryId IS NOT NULL OR CampaignLevel2TerritoryId IS NOT NULL))=0,0,1) as IsNFCTagFoundINTer"))
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCampaign.B2BCustomerId')
        ->where('B2BCustomer.CustomerId',$CustomerId)
        ->where('B2BCustomerCampaign.IsDelete','0')
        ->latest()
        ->get();

        return view('TagCampaignSelection.index',compact('B2BCustomerCampaigns'))
            ->with('NameOfOrganization', $B2BCustomer->NameOfOrganization)
            ->with('CustomerId', $B2BCustomer->CustomerId);
    }

}
