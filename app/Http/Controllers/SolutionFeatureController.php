<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SolutionFeature;

class SolutionFeatureController extends Controller
{
    public function index()
    {
        $SolutionFeature = SolutionFeature::where('IsDelete','0')->latest()->get();
        return view('SolutionFeature.index',compact('SolutionFeature'));
            //->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('SolutionFeature.create');
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
            'SolutionFeatureName' => 'required|unique:SolutionFeature,SolutionFeatureName,NULL,SolutionFeatureId,IsDelete,0'
            //'SolutionFeatureName' => 'required|unique:SolutionFeature'
        ]);

        $RequestData = array(); 
        $RequestData['SolutionFeatureName'] = $Request['SolutionFeatureName'];
        $RequestData['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        SolutionFeature::create($RequestData);

        return redirect()->route('CustomersSolutionFeaturesStep1.index',['id'=>$Request['B2BCustomerId']])->with('success','Solution feature created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SolutionFeature $SolutionFeature)
    {
        return view('SolutionFeature.show',compact('SolutionFeature'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SolutionFeature $SolutionFeature)
    {
        
        return view('SolutionFeature.edit',compact('SolutionFeature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $Request,SolutionFeature $SolutionFeature)
    { 
        request()->validate([
             'SolutionFeatureName' => 'required|unique:SolutionFeature,SolutionFeatureName,'.$SolutionFeature['SolutionFeatureId'].',SolutionFeatureId,IsDelete,0'
        ]);

        $RequestData = array(); 
        $RequestData['SolutionFeatureName'] = $Request['SolutionFeatureName'];
        $RequestData['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        $SolutionFeature->update($RequestData);

        return redirect()->route('CustomersSolutionFeaturesStep1.index',['id'=>$Request['B2BCustomerId']])->with('success','Solution feature updated successfully.');
    }
    
}
