<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomerProduct;
use App\B2BCustomerCampaign;
use App\CampaignProducts;

class CampaignsProductsStep2Controller extends Controller
{
    public function index()
    {
        $ProductArr = array();

        $CampaignId = $_GET['id'];

        $B2BCusCat = B2BCustomerCampaign::where('CampaignId',$CampaignId)->first();
        $B2BCustomerId =  $B2BCusCat['B2BCustomerId'];
        $CampaignName =  $B2BCusCat['CampaignName'];

        $B2BCustomerProducts = B2BCustomerProduct::select("B2BCustomer.NameOfOrganization","B2BCustomerProduct.*","CampaignProducts.CampaignProductId")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerProduct.B2BCustomerId')
        ->leftjoin('CampaignProducts', 'CampaignProducts.ProductId', '=', 'B2BCustomerProduct.ProductId')
        ->where('CampaignProducts.CampaignId','=',$CampaignId)
        ->where('B2BCustomerProduct.IsDelete','0')
        ->latest()
        ->get();

        foreach ($B2BCustomerProducts as $key => $value) {
            $ProductArr[] = $value['ProductId'];
        }

        $AvailableB2BCustomerProducts = B2BCustomerProduct::select("B2BCustomer.NameOfOrganization","B2BCustomerProduct.*")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerProduct.B2BCustomerId')
        ->whereNotIn('B2BCustomerProduct.ProductId', $ProductArr)
        ->where('B2BCustomerProduct.IsDelete','0')
        ->latest()
        ->get();

        return view('CampaignsProductsStep2.index',compact('B2BCustomerProducts'),compact('AvailableB2BCustomerProducts'))
            ->with('CampaignName', $CampaignName)
            ->with('B2BCustomerId', $B2BCustomerId)
            ->with('CampaignId', $CampaignId);
        
    }

    public function ChangeStatusToProduct(Request $Request,B2BCustomerProduct $B2BCustomerProduct)
    {
        if(isset($Request['ProductId'])){   
              B2BCustomerProduct::where('ProductId',$Request['ProductId'])->update( array(
                 'ActiveStatus' => $Request['ActiveStatus']
              ));
        }
    }

    public function RemoveProductFromCampaign(Request $Request)
    {
        if(isset($Request['CampaignProductId'])){
              $todo = CampaignProducts::findOrFail($Request['CampaignProductId']);
              $todo->delete();
        } 
    }

    public function AddProductInCampaign(Request $Request)
    {
        CampaignProducts::create($Request->all());
    }

    public function ViewCampaignsByProduct(Request $Request)
    {

        $CampaignsByProducts = B2BCustomerCampaign::select("B2BCustomer.NameOfOrganization","CampaignProducts.CampaignProductId","B2BCustomerCampaign.*")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCampaign.B2BCustomerId')
        ->leftjoin('CampaignProducts', 'CampaignProducts.CampaignId', '=', 'B2BCustomerCampaign.CampaignId')
        ->where('CampaignProducts.ProductId','=',$Request['ProductId'])
        ->where('B2BCustomerCampaign.IsDelete','0')
        ->get();
        
        $CampaignsByProductHtml = "";
        $CampaignsByProductHtml .= '<div class="modal-header">
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

                            foreach ($CampaignsByProducts as $CampaignsByProduct){

                                    $ActiveStatus = ($CampaignsByProduct->ActiveStatus==1)?"checked":"";

                                $CampaignsByProductHtml .='<tr id="row_'.$CampaignsByProduct->CampaignId.'">
                                    <td>'.$CampaignsByProduct->NameOfOrganization.'</td>
                                    <td>'.$CampaignsByProduct->CampaignName.'</td>
                                    <td class="text-center">
                                       <input type="checkbox" name="B2BCampaignStatus" id="'.$CampaignsByProduct->CampaignId.'"  '.$ActiveStatus.' value="'.$CampaignsByProduct->CampaignId.'">
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteCampaign('.$CampaignsByProduct->CampaignId.')" href="#"><i class="material-icons">close</i></a>
                                    </td>
                                </tr>';
                            }

        $CampaignsByProductHtml .='</tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>';


        echo $CampaignsByProductHtml;
    }

}
