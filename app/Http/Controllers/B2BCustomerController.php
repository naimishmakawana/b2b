<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomer;
use App\Country;
use App\ApplicationOwner;

class B2BCustomerController extends Controller
{
    public function index()
    {
        $B2BCustomers = B2BCustomer::where('IsDelete','0')->latest()->get();
        return view('B2BCustomer.index',compact('B2BCustomers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('B2BCustomer.create',[
            'Countries' => Country::all(),
            'ApplicationOwner' => ApplicationOwner::first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $Request)
    { 

        request()->validate([
            'NameOfOrganization' => 'required|unique:B2BCustomer,NameOfOrganization,NULL,CustomerId,IsDelete,0',
            //'NameOfOrganization' => 'required',
            'AddressFirstLine' => 'required',
            'City' => 'required',
            'State' => 'required',
            'PostalCode' => 'required',
            'CountryId' => 'required',
            'ContactPersonFirstName' => 'required',
            'ContactPersonFirstName' => 'required',
            'ContactPersonEmailAddress' => 'required',
            'ContactPersonDesignation' => 'required'
            
        ]);
        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        B2BCustomer::create($Request->all());
        return redirect()->route('B2BCustomerSelection.index',['flag'=>$Request['flag']])->with('success','B2B Customer created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(B2BCustomer $B2BCustomer)
    {
        
        return view('B2BCustomer.edit',compact('B2BCustomer'),[
            'Countries' => Country::all(),
            'ApplicationOwner' => ApplicationOwner::first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $Request,B2BCustomer $B2BCustomer)
    {
        request()->validate([
            //'NameOfOrganization' => 'required',
            'NameOfOrganization' => 'required|unique:B2BCustomer,NameOfOrganization,'.$B2BCustomer['CustomerId'].',CustomerId,IsDelete,0',
            'AddressFirstLine' => 'required',
            'City' => 'required',
            'State' => 'required',
            'PostalCode' => 'required',
            'CountryId' => 'required',
            'ContactPersonFirstName' => 'required',
            'ContactPersonFirstName' => 'required',
            'ContactPersonEmailAddress' => 'required',
            'ContactPersonDesignation' => 'required'
        ]);
   
        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        $B2BCustomer->update($Request->all());

        return redirect()->route('B2BCustomerSelection.index',['flag'=>$Request['flag']])->with('success','B2B Customer updated successfully.');
    }
    
}
