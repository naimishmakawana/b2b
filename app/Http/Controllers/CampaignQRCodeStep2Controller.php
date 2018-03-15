<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomer;
use App\B2BCustomerCampaign;
use App\CampaignLevel1Territory;
use App\CampaignLevel2Territory;
use App\QRCode;
use DB;

class CampaignQRCodeStep2Controller extends Controller
{
    
    public function AddQRCodeInCampaign(Request $Request)
    {
        if(isset($Request['CampaignId']) && ($Request['CampaignLevel1TerritoryId'] != 0) && ($Request['CampaignLevel2TerritoryId'] != 0))
        {
             CampaignLevel1Territory::where('CampaignLevel1TerritoryId',$Request['CampaignLevel1TerritoryId'])->update( array(
                 'QRCodeId' => $Request['QRCodeId']
              ));

             CampaignLevel2Territory::where('CampaignLevel2TerritoryId',$Request['CampaignLevel2TerritoryId'])->update( array(
                 'QRCodeId' => $Request['QRCodeId']
              ));

              B2BCustomerCampaign::where('CampaignId',$Request['CampaignId'])->update( array(
                 'QRCodeId' => $Request['QRCodeId']
              ));
        }
        elseif(isset($Request['CampaignId']) && ($Request['CampaignLevel1TerritoryId'] != 0))
        {
            
              CampaignLevel1Territory::where('CampaignLevel1TerritoryId',$Request['CampaignLevel1TerritoryId'])->update( array(
                 'QRCodeId' => $Request['QRCodeId']
              ));

              B2BCustomerCampaign::where('CampaignId',$Request['CampaignId'])->update( array(
                 'QRCodeId' => $Request['QRCodeId']
              ));
        }
        elseif(isset($Request['CampaignId']))
        { 
             B2BCustomerCampaign::where('CampaignId',$Request['CampaignId'])->update( array(
                 'QRCodeId' => $Request['QRCodeId']
              ));
        }
    }

    public function RemoveQRCodeInCampaign(Request $Request)
    {
        if(isset($Request['CampaignId']) && ($Request['CampaignLevel1TerritoryId'] != 0) && ($Request['CampaignLevel2TerritoryId'] != 0))
        {
             CampaignLevel1Territory::where('CampaignLevel1TerritoryId',$Request['CampaignLevel1TerritoryId'])->update( array(
                 'QRCodeId' => NULL
              ));

             CampaignLevel2Territory::where('CampaignLevel2TerritoryId',$Request['CampaignLevel2TerritoryId'])->update( array(
                 'QRCodeId' => NULL
              ));

              B2BCustomerCampaign::where('CampaignId',$Request['CampaignId'])->update( array(
                 'QRCodeId' => NULL
              ));
        }
        elseif(isset($Request['CampaignId']) && ($Request['CampaignLevel1TerritoryId'] != 0))
        {
            
              CampaignLevel1Territory::where('CampaignLevel1TerritoryId',$Request['CampaignLevel1TerritoryId'])->update( array(
                 'QRCodeId' => NULL
              ));

              B2BCustomerCampaign::where('CampaignId',$Request['CampaignId'])->update( array(
                 'QRCodeId' => NULL
              ));
        }
        elseif(isset($Request['CampaignId']))
        { 
             B2BCustomerCampaign::where('CampaignId',$Request['CampaignId'])->update( array(
                 'QRCodeId' => NULL
              ));
        }
    }

    public function UpdateQRCodeImageURL(Request $Request)
    {
        if(isset($Request['QRCodeId']))
        {
            QRCode::where('QRCodeId',$Request['QRCodeId'])->update( array(
                 'QRCodeImageURL' => $Request['QRImageURL']
              ));
        }
    }

    public function DeleteQRCode(Request $Request)
    {
        if(isset($Request['QRCodeId']))
        {
            QRCode::where('QRCodeId',$Request['QRCodeId'])->update( array(
                 'IsDelete' => 1
              ));
        }
    }

    public function ViewCampaignInQRCodes(Request $Request)
    {

        $B2BCustomerId = $_GET['B2BCustomerId'];
        $CampaignId = $_GET['CampaignId'];

        $B2BCustomerCampaign = B2BCustomerCampaign::where('CampaignId',$CampaignId)->first();
        $B2BCustomerId = $B2BCustomerCampaign->B2BCustomerId;

        $AvailableCampaignQRCodes = QRCode::select("QRCode.*")
        ->whereNotIn('QRCode.QRCodeId',function($query){
            $query->select('QRCodeId')->from('B2BCustomerCampaign')->where('IsDelete','0')->whereNotNull('QRCodeId');
          })
        ->where('QRCode.B2BCustomerId',$B2BCustomerId)
        ->where('QRCode.IsDelete','0')
        ->latest()
        ->get();

        $QRCodeHtml = "";
        $QRCodeHtml .= '<div class="modal-header">
                <h4 class="modal-title"><b>QR Code List</b></h4>
            </div>
            <div class="modal-body">
                
                    <table id="datatables4" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">QR Code No.</th>
                                    <th class="text-center">File Name</th>
                                    <th class="text-center">Image URL</th>
                                    <th class="text-center">Generator Name</th>
                                    <th class="text-center">QR Code</th>
                                    <th class="text-center">Remove</th>
                                    <th class="text-center">Add</th>
                                </tr>
                            </thead>
                            <tbody>';

                            foreach ($AvailableCampaignQRCodes as $AvailableCampaignQRCode){

                                $QRCodeHtml .='<tr id="qrrow_'.$AvailableCampaignQRCode->QRCodeId.'">
                                    <td class="text-center">'.$AvailableCampaignQRCode->QRCodeId.'</td>
                                    <td class="text-center">'.$AvailableCampaignQRCode->QRCodeFileName.'</td>
                                    <td class="text-center">'.$AvailableCampaignQRCode->QRCodeImageURL.'</td>
                                    <td class="text-center">'.$AvailableCampaignQRCode->QRCodeGeneratorName.'</td>';

                                    if(($_GET['CampaignLevel1TerritoryId'] != 0) && ($_GET['CampaignLevel2TerritoryId'] != 0)){
                                        $QRCodeHtml .='<td class="text-center" ><a href="'.url('QRCode/create').'?CampaignLevel1TerritoryId='.$_GET['CampaignLevel1TerritoryId'].'">Add / Remove</a></td>';
                                    } else if(($_GET['CampaignLevel1TerritoryId'] != 0)){
                                         $QRCodeHtml .='<td class="text-center" ><a href="'.url('QRCode/create').'?CampaignId='.$_GET['CampaignId'].'">Add / Remove</a></td>';
                                    } else {
                                        $QRCodeHtml .='<td class="text-center" ><a href="'.url('QRCode/create').'?B2BCustomerId='.$B2BCustomerId.'">Add / Remove</a></td>';
                                    } 
                                    $QRCodeHtml .='<td class="text-center">
                                        <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteQRCode('.$AvailableCampaignQRCode->QRCodeId.')" href="#"><i class="material-icons">close</i></a>
                                    </td>';


                                    if(($_GET['CampaignLevel1TerritoryId'] != 0) && ($_GET['CampaignLevel2TerritoryId'] != 0)){
                                        $QRCodeHtml .='<td class="text-center"> <a class="btn btn-simple btn-success btn-icon remove" onclick="OnAddQRCodeInCampaign('.$AvailableCampaignQRCode->QRCodeId.','.$CampaignId.','.$_GET['CampaignLevel1TerritoryId'].','.$_GET['CampaignLevel2TerritoryId'].')" href="#"><i class="material-icons dp48">add_circle</i></a></td>';
                                    } elseif(($_GET['CampaignLevel1TerritoryId'] != 0)){
                                         $QRCodeHtml .='<td class="text-center"> <a class="btn btn-simple btn-success btn-icon remove" onclick="OnAddQRCodeInCampaign('.$AvailableCampaignQRCode->QRCodeId.','.$CampaignId.','.$_GET['CampaignLevel1TerritoryId'].')" href="#"><i class="material-icons dp48">add_circle</i></a></td>';
                                    } else{
                                         $QRCodeHtml .='<td class="text-center"> <a class="btn btn-simple btn-success btn-icon remove" onclick="OnAddQRCodeInCampaign('.$AvailableCampaignQRCode->QRCodeId.','.$CampaignId.')" href="#"><i class="material-icons dp48">add_circle</i></a></td>';
                                    }
                                   

                                $QRCodeHtml .='</tr>';
                            }

        $QRCodeHtml .='</tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>';


        echo $QRCodeHtml;
    }

}
