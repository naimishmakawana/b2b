<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomerProduct;
use App\B2BCustomerCategory;
use App\CategoryProducts;
use App\CampaignProducts;

class CategoriesProductsStep2Controller extends Controller
{
    public function index()
    {

       
        $ProductArr = array();

        $CategoryId = $_GET['id'];

        $B2BCusCat = B2BCustomerCategory::where('CategoryId',$CategoryId)->first();
        $B2BCustomerId =  $B2BCusCat['B2BCustomerId'];
        $CategoryName =  $B2BCusCat['CategoryName'];

        $B2BCustomerProducts = B2BCustomerProduct::select("B2BCustomer.NameOfOrganization","B2BCustomerProduct.*","CategoryProducts.CategoryProductId")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerProduct.B2BCustomerId')
        ->leftjoin('CategoryProducts', 'CategoryProducts.ProductId', '=', 'B2BCustomerProduct.ProductId')
        ->where('CategoryProducts.CategoryId','=',$CategoryId)
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

        return view('CategoriesProductsStep2.index',compact('B2BCustomerProducts'),compact('AvailableB2BCustomerProducts'))
            ->with('CategoryName', $CategoryName)
            ->with('B2BCustomerId', $B2BCustomerId)
            ->with('CategoryId', $CategoryId);
        
    }

    public function ChangeStatusToProduct(Request $Request,B2BCustomerProduct $B2BCustomerProduct)
    {
        if(isset($Request['ProductId'])){   
              B2BCustomerProduct::where('ProductId',$Request['ProductId'])->update( array(
                 'ActiveStatus' => $Request['ActiveStatus']
              ));
        }
    }

    public function DeleteProduct(Request $Request,B2BCustomerProduct $B2BCustomerProduct)
    {
        if(isset($Request['ProductId'])){

              $B2BCustomerProduct->where('ProductId',$Request['ProductId'])->update(['IsDelete' => 1]);
              
              /*$todo = B2BCustomerProduct::findOrFail($Request['ProductId']);
              $todo->delete();

              $todo = CategoryProducts::where('ProductId',$Request['ProductId']);
              $todo->delete();

              $todo = CampaignProducts::where('ProductId',$Request['ProductId']);
              $todo->delete();*/
        }

    }

    public function RemoveProductFromCategoty(Request $Request)
    {
        if(isset($Request['CategoryProductId'])){
              $todo = CategoryProducts::findOrFail($Request['CategoryProductId']);
              $todo->delete();
        } 
    }

    public function AddProductInCategoty(Request $Request)
    {
        CategoryProducts::create($Request->all());
    }

    public function ViewCategoriesByProduct(Request $Request)
    {

        $CategotiesByProducts = B2BCustomerCategory::select("B2BCustomer.NameOfOrganization","CategoryProducts.CategoryProductId","B2BCustomerCategory.*")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCategory.B2BCustomerId')
        ->leftjoin('CategoryProducts', 'CategoryProducts.CategoryId', '=', 'B2BCustomerCategory.CategoryId')
        ->where('CategoryProducts.ProductId','=',$Request['ProductId'])
        ->where('B2BCustomerCategory.IsDelete','0')
        ->get(); 
        
        $CategotiesByProductHtml = "";
        $CategotiesByProductHtml .= '<div class="modal-header">
                <h4 class="modal-title"><b>Category List</b></h4>
            </div>
            <div class="modal-body">
                
                    <table id="datatables3" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>B2B Customer Name</th>
                                    <th>Category Name</th>
                                    <th class="disabled-sorting text-center">Active</th>
                                    <th class="disabled-sorting text-center">Deactive</th>
                                </tr>
                            </thead>
                            <tbody>';

                            foreach ($CategotiesByProducts as $CategotiesByProduct){

                                    $ActiveStatus = ($CategotiesByProduct->ActiveStatus==1)?"checked":"";

                                $CategotiesByProductHtml .='<tr id="row_'.$CategotiesByProduct->CategoryId.'">
                                    <td>'.$CategotiesByProduct->NameOfOrganization.'</td>
                                    <td>'.$CategotiesByProduct->CategoryName.'</td>
                                    <td class="text-center">
                                       <input type="checkbox" name="B2BCategoryStatus" id="'.$CategotiesByProduct->CategoryId.'"  '.$ActiveStatus.' value="'.$CategotiesByProduct->CategoryId.'">
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteCategory('.$CategotiesByProduct->CategoryId.')" href="#"><i class="material-icons">close</i></a>
                                    </td>
                                </tr>';
                            }

        $CategotiesByProductHtml .='</tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>';


        echo $CategotiesByProductHtml;
    }

}
