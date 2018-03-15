<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level1Territory;
use App\B2BCustomer;
use App\B2BCustomerCampaign;
use App\CampaignLevel1Territory;
use DB;

class CampaignsTerritoriesStep3Controller extends Controller
{
    public function index()
    {

        $Level1TerritoryArr = array();

        $CampaignId = $_GET['id'];

        $CustomerCampaign = B2BCustomerCampaign::where('CampaignId',$CampaignId)->first();
        $B2BCustomerId =  $CustomerCampaign['B2BCustomerId'];
        $CampaignName =  $CustomerCampaign['CampaignName'];

        $Level1Territories = Level1Territory::select("B2BCustomer.NameOfOrganization","Level1Territory.*","CampaignLevel1TerritoryId","TargetURL","CampaignLevel1Territory.QRCodeId")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'Level1Territory.B2BCustomerId')
        ->join('CampaignLevel1Territory', 'CampaignLevel1Territory.Level1TerritoryId', '=', 'Level1Territory.Level1TerritoryId')
        //->join('B2BCustomerCampaign', 'B2BCustomerCampaign.CampaignId', '=', 'CampaignLevel1Territory.CampaignId')
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

        return view('CampaignsTerritoriesStep3.index',compact('Level1Territories'),compact('AvailableLevel1Territories'))
            ->with('CampaignName', $CampaignName)
            ->with('B2BCustomerId', $B2BCustomerId)
            ->with('CampaignId', $CampaignId);
        
    }

    public function RemoveLevel1TerritoryFromCampaign(Request $Request)
    {
        if(isset($Request['CampaignLevel1TerritoryId'])){
              $todo = CampaignLevel1Territory::findOrFail($Request['CampaignLevel1TerritoryId']);
              $todo->delete();
        } 
    }

    public function AddLevel1TerritoryInCampaign(Request $Request)
    {
        CampaignLevel1Territory::create($Request->all());
    }

    public function SaveL1TerritoryTargetUrl(Request $Request)
    {
        //CampaignLevel1Territory::update($Request->all());
        CampaignLevel1Territory::where('CampaignLevel1TerritoryId',$Request['CampaignLevel1TerritoryId'])->update( array(
                 'TargetUrl' => $Request['TargetUrl']
                ));
    }

    public function ViewCampaignsByLevel1Territory(Request $Request)
    {

        $CampaignsByLevel1Territory = B2BCustomerCampaign::select("B2BCustomer.NameOfOrganization","B2BCustomerCampaign.*")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCampaign.B2BCustomerId')
        ->leftjoin('CampaignLevel1Territory', 'CampaignLevel1Territory.CampaignId', '=', 'B2BCustomerCampaign.CampaignId')
        ->where('CampaignLevel1Territory.Level1TerritoryId','=',$Request['Level1TerritoryId'])
        ->where('B2BCustomerCampaign.IsDelete','0')
        ->get();
        
        $CampaignsByLevel1TerritoryHtml = "";
        $CampaignsByLevel1TerritoryHtml .= '<div class="modal-header">
                <h4 class="modal-title"><b>Campaign List</b></h4>
            </div>
            <div class="modal-body">
                
                    <table id="datatables3" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>B2B Customer Name</th>
                                    <th>Campaign Name</th>
                                    <th class="disabled-sorting text-center">Active</th>
                                    <th class="disabled-sorting text-center">Deactive</th>
                                </tr>
                            </thead>
                            <tbody>';

                            foreach ($CampaignsByLevel1Territory as $CampaignByLevel1Territory){

                                    $ActiveStatus = ($CampaignByLevel1Territory->ActiveStatus==1)?"checked":"";

                                $CampaignsByLevel1TerritoryHtml .='<tr id="row_'.$CampaignByLevel1Territory->CampaignId.'">
                                    <td>'.$CampaignByLevel1Territory->NameOfOrganization.'</td>
                                    <td>'.$CampaignByLevel1Territory->CampaignName.'</td>
                                    <td class="text-center">
                                       <input type="checkbox" name="B2BCampaignStatus" id="'.$CampaignByLevel1Territory->CampaignId.'"  '.$ActiveStatus.' value="'.$CampaignByLevel1Territory->CampaignId.'">
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteCampaign('.$CampaignByLevel1Territory->CampaignId.')" href="#"><i class="material-icons">close</i></a>
                                    </td>
                                </tr>';
                            }

        $CampaignsByLevel1TerritoryHtml .='</tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>';


        echo $CampaignsByLevel1TerritoryHtml;
    }

}

