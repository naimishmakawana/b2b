<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level1Territory;
use App\B2BCustomer;
use App\B2BCustomerCampaign;
use App\CampaignLevel1Territory;
use DB;

class QRLevel1TerritorySelectionController extends Controller
{
    public function index()
    {

        $Level1TerritoryArr = array();

        $CampaignId = $_GET['id'];

        $CustomerCampaign = B2BCustomerCampaign::where('CampaignId',$CampaignId)->first();
        $B2BCustomerId =  $CustomerCampaign['B2BCustomerId'];
        $CampaignName =  $CustomerCampaign['CampaignName'];

        $QRCodeCount = CampaignLevel1Territory::select("CampaignLevel1TerritoryId")->where('CampaignId',$CampaignId)->whereNotNull('QRCodeId')->first();

        $Level1Territories = Level1Territory::select("B2BCustomer.NameOfOrganization","Level1Territory.*","CampaignLevel1TerritoryId","TargetURL","CampaignLevel1Territory.QRCodeId",
            DB::raw("(SELECT QRCodeFileName FROM QRCode WHERE QRCodeId=CampaignLevel1Territory.QRCodeId) as QRCodeFileName"),
            DB::raw("IF((Select count(*) from CampaignLevel2Territory where CampaignLevel1TerritoryId = CampaignLevel1Territory.CampaignLevel1TerritoryId and QRCodeId IS NOT NULL)=0,0,1) as IsQRFoundINL2Ter"),
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

        return view('QRLevel1TerritorySelection.index',compact('Level1Territories'),compact('AvailableLevel1Territories'))
            ->with('CampaignName', $CampaignName)
            ->with('B2BCustomerId', $B2BCustomerId)
            ->with('CampaignLevel1TerritoryId', count($QRCodeCount)>0?$QRCodeCount->CampaignLevel1TerritoryId:0)
            ->with('CampaignId', $CampaignId);
        
    }

}

