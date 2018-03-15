<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomerCampaign;
use App\B2BCustomer;
use App\CampaignsProducts;
use App\NFCTag;
use DB;

class CampaignsProductsStep1Controller extends Controller
{
    public function index()
    {
        $CustomerId = $_GET['id'];

        $B2BCustomer = B2BCustomer::where('CustomerId',$CustomerId)->first();

        $B2BCustomerCampaigns = B2BCustomerCampaign::select("B2BCustomer.NameOfOrganization","B2BCustomerCampaign.*")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCampaign.B2BCustomerId')
        ->where('B2BCustomer.CustomerId',$CustomerId)
        ->where('B2BCustomerCampaign.IsDelete','0')
        ->latest()
        ->get();

        return view('CampaignsProductsStep1.index',compact('B2BCustomerCampaigns'))
            ->with('NameOfOrganization', $B2BCustomer->NameOfOrganization)
            ->with('CustomerId', $B2BCustomer->CustomerId);
    }

    public function ChangeStatusToCampaign(Request $Request, B2BCustomerCampaign $B2BCustomerCampaign)
    {
        if(isset($Request['CampaignId'])){   
              B2BCustomerCampaign::where('CampaignId',$Request['CampaignId'])->update( array(
                 'ActiveStatus' => $Request['ActiveStatus']
              ));
        }
    }

    public function DeleteCampaign(Request $Request, B2BCustomerCampaign $B2BCustomerCampaign)
    {
        if(isset($Request['CampaignId'])){

              $B2BCustomerCampaign->where('CampaignId',$Request['CampaignId'])->update(['IsDelete' => 1]);

             /* $CusCatObj = B2BCustomerCampaign::findOrFail($Request['CampaignId']);
              $CusCatObj->delete();

              $CatProObj = CampaignsProducts::where('CampaignId',$Request['CampaignId']);
              $CatProObj->delete();*/
        }
 
    }

    public function ViewTagCampaignInTags(Request $Request)
    {
        $TagBundleInTags = NFCTag::select("NFCTag.*","TagManufacturer.ManufacturerName")
        ->join('TagManufacturer', 'TagManufacturer.TagManufacturerId', '=', 'NFCTag.TagManufacturerId')
        ->where('NFCTag.CampaignId','=',$Request['CampaignId'])
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
