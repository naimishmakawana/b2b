<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level1Territory;
use App\Level2Territory;
use App\B2BCustomer;
use App\B2BCustomerCampaign;
use App\CampaignLevel2Territory;
use DB;

class CampaignsTerritoriesStep4Controller extends Controller
{
    public function index()
    {

        $Level2TerritoryArr = array();

        $CampaignLevel1TerritoryId = $_GET['id'];

        $Level1Territory = Level1Territory::select("Level1Territory.*")
        ->join('CampaignLevel1Territory', 'CampaignLevel1Territory.Level1TerritoryId', '=', 'Level1Territory.Level1TerritoryId')
        ->where('CampaignLevel1TerritoryId',$CampaignLevel1TerritoryId)
        ->first();

        $B2BCustomerId =  $Level1Territory['B2BCustomerId'];
        $Level1TerritoryName =  $Level1Territory['Level1TerritoryName'];

        $Level2Territories = Level2Territory::select("B2BCustomer.NameOfOrganization","Level2Territory.*","CampaignLevel2Territory.CampaignLevel2TerritoryId","CampaignLevel2Territory.TargetURL","B2BCustomerCampaign.CampaignName", "CampaignLevel1Territory.CampaignId","CampaignLevel2Territory.QRCodeId")
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

        return view('CampaignsTerritoriesStep4.index',compact('Level2Territories'),compact('AvailableLevel2Territories'))
            ->with('Level1TerritoryName', $Level1TerritoryName)
            ->with('B2BCustomerId', $B2BCustomerId)
            ->with('CampaignLevel1TerritoryId', $CampaignLevel1TerritoryId);
        
    }

    public function RemoveCampaignL1TerFromCampaignL1Ter(Request $Request)
    {
        if(isset($Request['CampaignLevel2TerritoryId'])){
              $todo = CampaignLevel2Territory::findOrFail($Request['CampaignLevel2TerritoryId']);
              $todo->delete();
        } 
    }

    public function AddCampaignL1TerFromCampaignL1Ter(Request $Request)
    {
        request()->validate([
            'Level2TerritoryId' => 'required',
            'CampaignLevel1TerritoryId' => 'required',
            'TargetURL' => 'required'
        ]);

        CampaignLevel2Territory::create($Request->all());
        if(isset($Request['flag']) && $Request['flag'] != 'qrcode' && $Request['flag'] != 'tag')
            return redirect()->route('CampaignsTerritoriesStep4.index',['id'=>$Request['CampaignLevel1TerritoryId'],'flag'=>$Request['flag']]);
        elseif(isset($Request['flag']) && $Request['flag'] == 'qrcode')
            return redirect()->route('QRLevel2TerritorySelection.index',['id'=>$Request['CampaignLevel1TerritoryId']]);
        elseif(isset($Request['flag']) && $Request['flag'] == 'tag')
            return redirect()->route('TagLevel2TerritorySelection.index',['id'=>$Request['CampaignLevel1TerritoryId']]);
        else
            return redirect()->route('CampaignsTerritoriesStep4.index',['id'=>$Request['CampaignLevel1TerritoryId']]);
    }

    public function SaveL2TerritoryTargetUrl(Request $Request)
    {
        
        request()->validate([
            'CampaignLevel2TerritoryId' => 'required',
            'TargetURL' => 'required'
        ]);

        CampaignLevel2Territory::where('CampaignLevel2TerritoryId',$Request['CampaignLevel2TerritoryId'])->update( array(
                 'TargetURL' => $Request['TargetURL']
                ));
    }

    public function ViewCampaignL1TerByCampaignL2Ter(Request $Request)
    {

        $CampaignsByLevel2Territory = B2BCustomerCampaign::select("B2BCustomer.NameOfOrganization","B2BCustomerCampaign.*")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCampaign.B2BCustomerId')
        ->join('CampaignLevel1Territory', 'CampaignLevel1Territory.CampaignId', '=', 'B2BCustomerCampaign.CampaignId')
        ->join('CampaignLevel2Territory', 'CampaignLevel2Territory.CampaignLevel1TerritoryId', '=', 'CampaignLevel1Territory.CampaignLevel1TerritoryId')
        ->where('CampaignLevel2Territory.Level2TerritoryId','=',$Request['Level2TerritoryId'])
        ->where('B2BCustomerCampaign.IsDelete','0')
        //->groupBy('B2BCustomerCampaign.CampaignId')
        ->get();
        
        $CampaignsByLevel2TerritoryHtml = "";
        $CampaignsByLevel2TerritoryHtml .= '<div class="modal-header">
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

                            foreach ($CampaignsByLevel2Territory as $CampaignByLevel2Territory){

                                    $ActiveStatus = ($CampaignByLevel2Territory->ActiveStatus==1)?"checked":"";

                                $CampaignsByLevel2TerritoryHtml .='<tr id="row_'.$CampaignByLevel2Territory->CampaignId.'">
                                    <td>'.$CampaignByLevel2Territory->NameOfOrganization.'</td>
                                    <td>'.$CampaignByLevel2Territory->CampaignName.'</td>
                                    <td class="text-center">
                                       <input type="checkbox" name="B2BCampaignStatus" id="'.$CampaignByLevel2Territory->CampaignId.'"  '.$ActiveStatus.' value="'.$CampaignByLevel2Territory->CampaignId.'">
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteCampaign('.$CampaignByLevel2Territory->CampaignId.')" href="#"><i class="material-icons">close</i></a>
                                    </td>
                                </tr>';
                            }

        $CampaignsByLevel2TerritoryHtml .='</tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>';


        echo $CampaignsByLevel2TerritoryHtml;
    }

}

