<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomer;
use App\B2BCustomerCampaign;
use App\NFCTag;
use App\CampaignLevel2Territory;
use DB;

class CampaignWithL2TerTagsStep3Controlle extends Controller
{
    public function index()
    {
        $NFCTagBundleArr = array();

        $CampaignLevel2TerritoryId = $_GET['id'];

        $Level2Territory = CampaignLevel2Territory::select("Level2Territory.*","CampaignLevel2Territory.Level2TerritoryId","CampaignLevel1Territory.CampaignId","CampaignLevel1Territory.CampaignLevel1TerritoryId")
        ->join('CampaignLevel1Territory', 'CampaignLevel1Territory.CampaignLevel1TerritoryId', '=', 'CampaignLevel2Territory.CampaignLevel1TerritoryId')
        ->join('Level2Territory', 'Level2Territory.Level2TerritoryId', '=', 'CampaignLevel2Territory.Level2TerritoryId')
        ->where('CampaignLevel2TerritoryId',$CampaignLevel2TerritoryId)
        ->first();

        $CampaignLevel1TerritoryId =  $Level2Territory['CampaignLevel1TerritoryId'];
        $Level2TerritoryId =  $Level2Territory['Level2TerritoryId'];
        $Level2TerritoryName =  $Level2Territory['Level2TerritoryName'];
        $CampaignId =  $Level2Territory['CampaignId'];

        $CampaignNFCTags = NFCTag::select("NFCTag.*","B2BCustomer.NameOfOrganization")
        ->join('B2BCustomerCampaign', 'B2BCustomerCampaign.CampaignId', '=', 'NFCTag.CampaignId')
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCampaign.B2BCustomerId')
        ->where('NFCTag.CampaignLevel2TerritoryId','=',$CampaignLevel2TerritoryId)
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
        ->where('NFCTag.CampaignLevel2TerritoryId',NULL)
        ->where('NFCTag.CampaignId',NULL)
        ->where('NFCTag.IsDelete','0')
        ->groupBy('TagBundleId')
        ->latest()
        ->get();

        return view('CampaignWithL2TerTagsStep3.index',compact('CampaignNFCTags'),compact('AvailableCampaignNFCTags'))
            ->with('Level2TerritoryName', $Level2TerritoryName)
            ->with('Level2TerritoryId', $Level2TerritoryId)
            ->with('CampaignId', $CampaignId)
            ->with('CampaignLevel1TerritoryId', $CampaignLevel1TerritoryId)
            ->with('CampaignLevel2TerritoryId', $CampaignLevel2TerritoryId);
        
    }

    public function RemoveTagBundleFromL2Territory(Request $Request)
    { 
        if(isset($Request['TagBundleId'])){

             NFCTag::where('TagBundleId',$Request['TagBundleId'])->update( array(
                'CampaignLevel1TerritoryId' => NULL,
                'CampaignLevel2TerritoryId' => NULL,
                'CampaignId' => NULL
              ));
        } 
    }

    public function AddTagBundleInL2Territory(Request $Request)
    {
        if(isset($Request['TagBundleId'])){
             NFCTag::where('TagBundleId',$Request['TagBundleId'])->update( array(
                 'CampaignLevel1TerritoryId' => $Request['CampaignLevel1TerritoryId'],
                 'CampaignLevel2TerritoryId' => $Request['CampaignLevel2TerritoryId'],
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
