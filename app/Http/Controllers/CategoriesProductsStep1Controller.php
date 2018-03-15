<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomerCategory;
use App\B2BCustomer;
use App\CategoryProducts;

class CategoriesProductsStep1Controller extends Controller
{
    public function index()
    {
        $CustomerId = $_GET['id'];

        $B2BCustomer = B2BCustomer::where('CustomerId',$CustomerId)->first();

        $B2BCustomerCategories = B2BCustomerCategory::select("B2BCustomer.NameOfOrganization","B2BCustomerCategory.*")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCategory.B2BCustomerId')
        ->where('B2BCustomer.CustomerId',$CustomerId)
        ->where('B2BCustomerCategory.IsDelete','0')
        ->latest()
        ->get();

        return view('CategoriesProductsStep1.index',compact('B2BCustomerCategories'))
            ->with('NameOfOrganization', $B2BCustomer->NameOfOrganization)
            ->with('CustomerId', $B2BCustomer->CustomerId);
    }

    public function ChangeStatusToCategory(Request $Request, B2BCustomerCategory $B2BCustomerCategory)
    {
        if(isset($Request['CategoryId'])){   
              B2BCustomerCategory::where('CategoryId',$Request['CategoryId'])->update( array(
                 'ActiveStatus' => $Request['ActiveStatus']
              ));
        }
    }

    public function DeleteCategory(Request $Request, B2BCustomerCategory $B2BCustomerCategory)
    {
        if(isset($Request['CategoryId'])){

              $B2BCustomerCategory->where('CategoryId',$Request['CategoryId'])->update(['IsDelete' => 1]);
              
              /*$CusCatObj = B2BCustomerCategory::findOrFail($Request['CategoryId']);
              $CusCatObj->delete();

              $CatProObj = CategoryProducts::where('CategoryId',$Request['CategoryId']);
              $CatProObj->delete();*/
        }
 
    }

}
