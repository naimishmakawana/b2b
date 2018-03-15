<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryProducts;
use App\TagManufacturer;
use App\B2BCustomer;
use App\CustomerTagManufacturers;

class CustomersTagManufacturersStep1Controller extends Controller
{
    public function index()
    {
        $TagManufacturerIdArr = array();

        $B2BCustomerId = $_GET['id'];

        $B2BCustomers = B2BCustomer::where('CustomerId',$B2BCustomerId)->first();
        $NameOfOrganization =  $B2BCustomers['NameOfOrganization'];

        $CustomerTagmanufacturers = TagManufacturer::select("B2BCustomer.NameOfOrganization","TagManufacturer.*","CustomerTagManufacturers.CustomerTagManufacturerId")
        ->leftjoin('CustomerTagManufacturers', 'CustomerTagManufacturers.TagManufacturerId', '=', 'TagManufacturer.TagManufacturerId')
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'CustomerTagManufacturers.B2BCustomerId')
        ->where('CustomerTagManufacturers.B2BCustomerId','=',$B2BCustomerId)
        ->where('TagManufacturer.IsDelete','0')
        ->latest()
        ->get();

        foreach ($CustomerTagmanufacturers as $CustomerTagmanufacturer) {
            $TagManufacturerIdArr[] = $CustomerTagmanufacturer['TagManufacturerId'];
        }

        $AvailableCustomerTagmanufacturers = TagManufacturer::select("TagManufacturer.*")
        ->whereNotIn('TagManufacturer.TagManufacturerId', $TagManufacturerIdArr)
        ->where('TagManufacturer.IsDelete','0')
        ->latest()
        ->get();

        return view('CustomersTagManufacturersStep1.index',compact('CustomerTagmanufacturers'),compact('AvailableCustomerTagmanufacturers'))
            ->with('NameOfOrganization', $NameOfOrganization)
            ->with('B2BCustomerId', $B2BCustomerId);
        
    }

    public function ChangeStatusToTagManufacturer(Request $Request,TagManufacturer $TagManufacturer)
    {
        if(isset($Request['TagManufacturerId'])){   
              TagManufacturer::where('TagManufacturerId',$Request['TagManufacturerId'])->update( array(
                 'ActiveStatus' => $Request['ActiveStatus']
              ));
        }
    }

    public function DeleteTagManufacturer(Request $Request,TagManufacturer $TagManufacturer)
    {
        if(isset($Request['TagManufacturerId'])){

              $TagManufacturer->where('TagManufacturerId',$Request['TagManufacturerId'])->update(['IsDelete' => 1]);

              /*$TagObj = TagManufacturer::findOrFail($Request['TagManufacturerId']);
              $TagObj->delete();

              $TagObj = CustomerTagManufacturers::where('TagManufacturerId',$Request['TagManufacturerId']);
              $TagObj->delete();*/
        }

    }

    public function RemoveTagManufacturerFromCustomer(Request $Request)
    {
        if(isset($Request['CategoryTagManufacturerId'])){
              $TagObj = CustomerTagManufacturers::findOrFail($Request['CategoryTagManufacturerId']);
              $TagObj->delete();
        } 
    }

    public function AddTagManuFacturerInCustomer(Request $Request)
    {
        CustomerTagManufacturers::create($Request->all());
    }

}
