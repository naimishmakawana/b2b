<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomer;

class QRCustomerSelectionController extends Controller
{
    public function index()
    {
        $B2BCustomers = B2BCustomer::where('IsDelete','0')->latest()->get();
        return view('QRCustomerSelection.index',compact('B2BCustomers'));
    }

}
