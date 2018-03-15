<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomerCampaign;
use App\B2BCustomer;
use App\CampaignsProducts;
use DB;

class QRCampaignSelectionController extends Controller
{
    public function index()
    {
        $CustomerId = $_GET['id'];

        $B2BCustomer = B2BCustomer::where('CustomerId',$CustomerId)->first();

        $B2BCustomerCampaigns = B2BCustomerCampaign::select("B2BCustomer.NameOfOrganization","B2BCustomerCampaign.*",
            DB::raw("(SELECT QRCodeFileName FROM QRCode WHERE QRCodeId=B2BCustomerCampaign.QRCodeId) as QRCodeFileName"),
            DB::raw("IF((Select count(*) from CampaignLevel1Territory where CampaignId = B2BCustomerCampaign.CampaignId and QRCodeId IS NOT NULL)=0 and (Select count(*) from CampaignLevel2Territory L2T JOIN CampaignLevel1Territory L1T ON L2T.CampaignLevel1TerritoryId=L1T.CampaignLevel1TerritoryId where L1T.CampaignId = B2BCustomerCampaign.CampaignId and L2T.QRCodeId IS NOT NULL)=0,0,1) as IsQRFoundINTer"),
            DB::raw("IF((QRCodeId IS NOT NULL)=0,0,1) as IsQRFoundINCmp"))
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCampaign.B2BCustomerId')
        ->where('B2BCustomer.CustomerId',$CustomerId)
        ->where('B2BCustomerCampaign.IsDelete','0')
        ->latest()
        ->get();

        return view('QRCampaignSelection.index',compact('B2BCustomerCampaigns'))
            ->with('NameOfOrganization', $B2BCustomer->NameOfOrganization)
            ->with('CustomerId', $B2BCustomer->CustomerId);
    }

}
