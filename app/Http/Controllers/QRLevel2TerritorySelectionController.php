<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level1Territory;
use App\Level2Territory;
use App\B2BCustomer;
use App\B2BCustomerCampaign;
use App\CampaignLevel2Territory;
use DB;

class QRLevel2TerritorySelectionController extends Controller
{
    public function index()
    {

        $Level2TerritoryArr = array();

        $CampaignLevel1TerritoryId = $_GET['id'];

        $Level1Territory = Level1Territory::select("Level1Territory.*")
        ->join('CampaignLevel1Territory', 'CampaignLevel1Territory.Level1TerritoryId', '=', 'Level1Territory.Level1TerritoryId')
        ->where('CampaignLevel1TerritoryId',$CampaignLevel1TerritoryId)
        ->first();

        $QRCodeCount = CampaignLevel2Territory::select("CampaignLevel2TerritoryId")->where('CampaignLevel1TerritoryId',$CampaignLevel1TerritoryId)->whereNotNull('QRCodeId')->first();

        $B2BCustomerId =  $Level1Territory['B2BCustomerId'];
        $Level1TerritoryName =  $Level1Territory['Level1TerritoryName'];

        $Level2Territories = Level2Territory::select("B2BCustomer.NameOfOrganization","Level2Territory.*","CampaignLevel2Territory.CampaignLevel2TerritoryId","CampaignLevel2Territory.TargetURL","B2BCustomerCampaign.CampaignName", "CampaignLevel1Territory.CampaignId","CampaignLevel2Territory.QRCodeId", 
            DB::raw("(SELECT QRCodeFileName FROM QRCode WHERE QRCodeId=CampaignLevel2Territory.QRCodeId) as QRCodeFileName"))

        ->join('CampaignLevel2Territory', 'CampaignLevel2Territory.Level2TerritoryId', '=', 'Level2Territory.Level2TerritoryId')
        ->join('CampaignLevel1Territory', 'CampaignLevel1Territory.CampaignLevel1TerritoryId', '=', 'CampaignLevel2Territory.CampaignLevel1TerritoryId')
        ->join('B2BCustomerCampaign', 'B2BCustomerCampaign.CampaignId', '=', 'CampaignLevel1Territory.CampaignId')
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCampaign.B2BCustomerId')
        ->where('CampaignLevel2Territory.CampaignLevel1TerritoryId',$CampaignLevel1TerritoryId)
        ->where('Level2Territory.IsDelete','0')
        ->latest()
        ->get();

        foreach ($Level2Territories as $key => $value) {
            $Level2TerritoryArr[] = $value['Level2TerritoryId'];
        }

        $AvailableLevel2Territories = Level2Territory::select("Level2Territory.*")->whereNotIn('Level2Territory.Level2TerritoryId', $Level2TerritoryArr)
        ->where('Level2Territory.IsDelete','0')
        ->latest()
        ->get();

        return view('QRLevel2TerritorySelection.index',compact('Level2Territories'),compact('AvailableLevel2Territories'))
            ->with('Level1TerritoryName', $Level1TerritoryName)
            ->with('B2BCustomerId', $B2BCustomerId)
            ->with('CampaignLevel2TerritoryId', count($QRCodeCount)>0?$QRCodeCount->CampaignLevel2TerritoryId:0)
            ->with('CampaignLevel1TerritoryId', $CampaignLevel1TerritoryId);
        
    }
}

