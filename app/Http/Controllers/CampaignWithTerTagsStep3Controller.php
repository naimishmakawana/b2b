<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomer;
use App\B2BCustomerCampaign;
use App\NFCTag;
use App\CampaignLevel1Territory;
use DB;

class CampaignWithTerTagsStep3Controller extends Controller
{
    public function index()
    {
        $NFCTagBundleArr = array();

        $CampaignLevel1TerritoryId = $_GET['id'];

        $Level1Territory = CampaignLevel1Territory::select("Level1Territory.*","CampaignLevel1Territory.CampaignId")
        ->join('Level1Territory', 'Level1Territory.Level1TerritoryId', '=', 'CampaignLevel1Territory.Level1TerritoryId')
        ->where('CampaignLevel1TerritoryId',$CampaignLevel1TerritoryId)
        ->first();

        $CampaignId =  $Level1Territory['CampaignId'];
        $Level1TerritoryName =  $Level1Territory['Level1TerritoryName'];

        $CampaignNFCTags = NFCTag::select("NFCTag.*","B2BCustomer.NameOfOrganization")
        ->join('B2BCustomerCampaign', 'B2BCustomerCampaign.CampaignId', '=', 'NFCTag.CampaignId')
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCampaign.B2BCustomerId')
        ->where('NFCTag.CampaignLevel1TerritoryId','=',$CampaignLevel1TerritoryId)
        ->where('NFCTag.CampaignLevel2TerritoryId',NULL)
        ->where('NFCTag.IsDelete','0')
        ->groupBy('TagBundleId')
        ->latest()
        ->get();

        foreach ($CampaignNFCTags as $key => $value) {
            $NFCTagBundleArr[] = $value['NFCTagId'];
        }

        $AvailableCampaignNFCTags = NFCTag::select("NFCTag.*","TagManufacturer.ManufacturerName",DB::raw('COUNT(*) as TagCnt'))
        ->join('TagManufacturer', 'TagManufacturer.TagManufacturerId', '=', 'NFCTag.TagManufacturerId')
        ->whereNotIn('NFCTag.NFCTagId', $NFCTagBundleArr)
        ->where('NFCTag.CampaignLevel1TerritoryId',NULL)
        ->where('NFCTag.CampaignId',NULL)
        ->where('NFCTag.IsDelete','0')
        ->groupBy('TagBundleId')
        ->latest()
        ->get();

        return view('CampaignWithTerTagsStep3.index',compact('CampaignNFCTags'),compact('AvailableCampaignNFCTags'))
            ->with('Level1TerritoryName', $Level1TerritoryName)
            ->with('CampaignId', $CampaignId)
            ->with('CampaignLevel1TerritoryId', $CampaignLevel1TerritoryId);
        
    }

    public function RemoveTagBundleFromL1Territory(Request $Request)
    { 
        if(isset($Request['TagBundleId'])){

             NFCTag::where('TagBundleId',$Request['TagBundleId'])->update( array(
                'CampaignLevel1TerritoryId' => NULL,
                'CampaignId' => NULL
              ));
        } 
    }

    public function AddTagBundleInL1Territory(Request $Request)
    {
        if(isset($Request['TagBundleId'])){
             NFCTag::where('TagBundleId',$Request['TagBundleId'])->update( array(
                 'CampaignLevel1TerritoryId' => $Request['CampaignLevel1TerritoryId'],
                 'CampaignId' => $Request['CampaignId']
              ));
        }
    }

    public function ViewTagBundleInTags(Request $Request)
    {

        $TagBundleInTags = NFCTag::select("NFCTag.*","TagManufacturer.ManufacturerName")
        ->join('TagManufacturer', 'TagManufacturer.TagManufacturerId', '=', 'NFCTag.TagManufacturerId')
        ->where('NFCTag.TagBundleId','=',$Request['TagBundleId'])
        ->where('NFCTag.IsDelete','0')
        ->get(); 
        
        $TagBundleInTagHtml = "";
        $TagBundleInTagHtml .= '<div class="modal-header">
                <h4 class="modal-title"><b>Tag List</b></h4>
            </div>
            <div class="modal-body">
                
                    <table id="datatables3" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Tag ID</th>
                                    <th>Manufacturer</th>
                                    <th class="text-center">Tag Bundle ID</th>
                                    <th>Tag URL</th>
                                    <th>Redirect URL</th>
                                </tr>
                            </thead>
                            <tbody>';

                            foreach ($TagBundleInTags as $TagBundleInTag){

                                   

                                $TagBundleInTagHtml .='<tr id="row_'.$TagBundleInTag->CampaignId.'">
                                    <td class="text-center">'.$TagBundleInTag->TagId.'</td>
                                    <td>'.$TagBundleInTag->ManufacturerName.'</td>
                                    <td class="text-center">'.$TagBundleInTag->TagBundleId.'</td>
                                    <td>'.$TagBundleInTag->TagURL.'</td>
                                    <td>'.$TagBundleInTag->RedirectURL.'</td>
                                </tr>';
                            }

        $TagBundleInTagHtml .='</tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>';


        echo $TagBundleInTagHtml;
    }

}
