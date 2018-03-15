<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomer;
use App\B2BCustomerCampaign;
use App\NFCTag;
use DB;
class CampaignTagsStep4Controller extends Controller
{
    public function index()
    {
        $NFCTagBundleArr = array();

        $CampaignId = $_GET['id'];

        $B2BCusCat = B2BCustomerCampaign::where('CampaignId',$CampaignId)->first();
        $B2BCustomerId =  $B2BCusCat['B2BCustomerId'];
        $CampaignName =  $B2BCusCat['CampaignName'];

        $CampaignNFCTags = NFCTag::select("NFCTag.*","B2BCustomer.NameOfOrganization","TagManufacturer.ManufacturerName")
        ->join('TagManufacturer', 'TagManufacturer.TagManufacturerId', '=', 'NFCTag.TagManufacturerId')
        ->join('B2BCustomerCampaign', 'B2BCustomerCampaign.CampaignId', '=', 'NFCTag.CampaignId')
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCampaign.B2BCustomerId')
        ->where('NFCTag.CampaignId','=',$CampaignId)
        ->where('NFCTag.IsDelete','0')
        ->latest()
        ->get();

        foreach ($CampaignNFCTags as $key => $value) {
            $NFCTagBundleArr[] = $value['NFCTagId'];
        }

        $AvailableCampaignNFCTags = NFCTag::select("NFCTag.*","TagManufacturer.ManufacturerName")
        ->join('TagManufacturer', 'TagManufacturer.TagManufacturerId', '=', 'NFCTag.TagManufacturerId')
        ->whereNotIn('NFCTag.NFCTagId', $NFCTagBundleArr)
        ->where('NFCTag.CampaignId',NULL)
        ->where('NFCTag.IsDelete','0')
        ->latest()
        ->get();

        return view('CampaignTagsStep4.index',compact('CampaignNFCTags'),compact('AvailableCampaignNFCTags'))
            ->with('CampaignName', $CampaignName)
            ->with('B2BCustomerId', $B2BCustomerId)
            ->with('CampaignId', $CampaignId);
        
    }

    public function RemoveTagFromCampaign(Request $Request)
    { 
        if(isset($Request['NFCTagId'])){

             NFCTag::where('NFCTagId',$Request['NFCTagId'])->update( array(
                 'CampaignId' => NULL
              ));
        } 
    }

    public function AddTagInCampaign(Request $Request)
    {
        if(isset($Request['NFCTagId'])){
             NFCTag::where('NFCTagId',$Request['NFCTagId'])->update( array(
                 'CampaignId' => $Request['CampaignId']
              ));
        }
    }

}
