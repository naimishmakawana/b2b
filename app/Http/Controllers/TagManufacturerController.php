<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TagManufacturer;
use App\Country;
use App\ApplicationOwner;

class TagManufacturerController extends Controller
{
    public function index()
    {
        $TagManufacturer = TagManufacturer::where('IsDelete','0')->latest()->get();
        return view('TagManufacturer.index',compact('TagManufacturer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('TagManufacturer.create',[
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
            'ManufacturerName' => 'required|unique:TagManufacturer,ManufacturerName,NULL,TagManufacturerId,IsDelete,0',
            //'ManufacturerName' => 'required|unique:TagManufacturer',
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
        TagManufacturer::create($Request->all());
        return redirect()->route('CustomersTagManufacturersStep1.index',['id'=>$Request['B2BCustomerId']])->with('success','Tag manufacturer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TagManufacturer $TagManufacturer)
    {
        return view('TagManufacturer.show',compact('TagManufacturer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TagManufacturer $TagManufacturer)
    {
        
        return view('TagManufacturer.edit',compact('TagManufacturer'),[
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
    public function update(Request $Request,TagManufacturer $TagManufacturer)
    { 
        request()->validate([
            'ManufacturerName' => 'required|unique:TagManufacturer,ManufacturerName,'.$TagManufacturer['TagManufacturerId'].',TagManufacturerId,IsDelete,0',
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
        $TagManufacturer->update($Request->all());

        return redirect()->route('CustomersTagManufacturersStep1.index',['id'=>$Request['B2BCustomerId']])->with('success','Tag manufacturer updated successfully.');
    }
    
}
