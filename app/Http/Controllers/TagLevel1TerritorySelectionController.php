<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level1Territory;
use App\B2BCustomer;
use App\B2BCustomerCampaign;
use App\CampaignLevel1Territory;
use DB;

class TagLevel1TerritorySelectionController extends Controller
{
    public function index()
    {

        $Level1TerritoryArr = array();

        $CampaignId = $_GET['id'];

        $CustomerCampaign = B2BCustomerCampaign::where('CampaignId',$CampaignId)->first();
        $B2BCustomerId =  $CustomerCampaign['B2BCustomerId'];
        $CampaignName =  $CustomerCampaign['CampaignName'];

        $Level1Territories = Level1Territory::select("B2BCustomer.NameOfOrganization","Level1Territory.*","CampaignLevel1TerritoryId","TargetURL",
            DB::raw("IF((Select count(*) from NFCTag where CampaignId = CampaignLevel1Territory.CampaignId and CampaignLevel1TerritoryId = CampaignLevel1Territory.CampaignLevel1TerritoryId and CampaignLevel2TerritoryId IS NOT NULL)=0,0,1) as IsNFCTagFoundINL2Ter"),
            DB::raw("IF((Select count(*) from NFCTag where CampaignId = CampaignLevel1Territory.CampaignId and CampaignLevel1TerritoryId = CampaignLevel1Territory.CampaignLevel1TerritoryId and CampaignLevel2TerritoryId IS NULL)=0,0,1) as IsNFCTagFoundINL1Ter"),
            DB::raw("IF((CampaignLevel1Territory.QRCodeId IS NOT NULL)=0,0,1) as IsQRFoundINL1Ter"))
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'Level1Territory.B2BCustomerId')
        ->join('CampaignLevel1Territory', 'CampaignLevel1Territory.Level1TerritoryId', '=', 'Level1Territory.Level1TerritoryId')
        ->where('CampaignLevel1Territory.CampaignId',$CampaignId)
        ->where('Level1Territory.IsDelete','0')
        ->latest()
        ->get();

        foreach ($Level1Territories as $key => $value) {
            $Level1TerritoryArr[] = $value['Level1TerritoryId'];
        }

        $AvailableLevel1Territories = Level1Territory::select("Level1Territory.*")->whereNotIn('Level1Territory.Level1TerritoryId', $Level1TerritoryArr)
        ->where('Level1Territory.IsDelete','0')
        ->latest()
        ->get();

        return view('TagLevel1TerritorySelection.index',compact('Level1Territories'),compact('AvailableLevel1Territories'))
            ->with('CampaignName', $CampaignName)
            ->with('B2BCustomerId', $B2BCustomerId)
            ->with('CampaignId', $CampaignId);
        
    }

}

