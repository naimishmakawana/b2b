<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomer;

class B2BCustomerSelectionController extends Controller
{
    public function index()
    {
        $B2BCustomers = B2BCustomer::where('IsDelete','0')->latest()->get();
        return view('B2BCustomerSelection.index',compact('B2BCustomers'));
    }

    public function ChangeStatusToCustomer(Request $Request, B2BCustomer $B2BCustomer)
    {
        if(isset($Request['CustomerId'])){   
              B2BCustomer::where('CustomerId',$Request['CustomerId'])->update( array(
                 'ActiveStatus' => $Request['ActiveStatus']
              ));
        }
    }

    public function DeleteCustomer(Request $Request, B2BCustomer $B2BCustomer)
    {
        if(isset($Request['CustomerId'])){

              $B2BCustomer->where('CustomerId',$Request['CustomerId'])->update(['IsDelete' => 1]);

        }
    }

}
