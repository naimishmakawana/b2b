<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomer;

class TagCustomerSelectionController extends Controller
{
    public function index()
    {
        $B2BCustomers = B2BCustomer::where('IsDelete','0')->latest()->get();
        return view('TagCustomerSelection.index',compact('B2BCustomers'));
    }

}
