<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level2Territory;

class Level2TerritoryController extends Controller
{
    public function index()
    {
        $Level2Territory = Level2Territory::where('IsDelete','0')->latest()->get();
        return view('Level2Territory.index',compact('Level2Territory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('Level2Territory.create');
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
            'Level2TerritoryName' => 'required|unique:Level2Territory,Level2TerritoryName,NULL,Level2TerritoryId,IsDelete,0'
            //'Level2TerritoryName' => 'required|unique:Level2Territory'
        ]);

        $RequestData = array(); 
        $RequestData['Level2TerritoryName'] = $Request['Level2TerritoryName'];
        $RequestData['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        Level2Territory::create($RequestData);
       
        if(isset($Request['Level1TerritoryId']) && $Request['Level1TerritoryId']!='')
            return redirect()->route('Territory1Territory2Step2.index',['id'=>$Request['Level1TerritoryId']])->with('success','Level 2 Territory created successfully.');
        else if(isset($Request['CampaignLevel1TerritoryId']) && $Request['CampaignLevel1TerritoryId']!='')
            return redirect()->route('CampaignsTerritoriesStep4.index',['id'=>$Request['CampaignLevel1TerritoryId']])->with('success','Level 2 Territory created successfully.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Level2Territory $Level2Territory)
    {
        return view('Level2Territory.show',compact('Level2Territory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Level2Territory $Level2Territory)
    {
        
        return view('Level2Territory.edit',compact('Level2Territory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $Request,Level2Territory $Level2Territory)
    { 
        request()->validate([
             'Level2TerritoryName' => 'required|unique:Level2Territory,Level2TerritoryName,'.$Level2Territory['Level2TerritoryId'].',Level2TerritoryId,IsDelete,0'
        ]);

        $RequestData = array(); 
        $RequestData['Level2TerritoryName'] = $Request['Level2TerritoryName'];
        $RequestData['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        $Level2Territory->update($RequestData);

        if(isset($Request['Level1TerritoryId']) && $Request['Level1TerritoryId']!='')
            return redirect()->route('Territory1Territory2Step2.index',['id'=>$Request['Level1TerritoryId']])->with('success','Level 2 Territory updated successfully.');
        else if(isset($Request['CampaignLevel1TerritoryId']) && $Request['CampaignLevel1TerritoryId']!='')
            return redirect()->route('CampaignsTerritoriesStep4.index',['id'=>$Request['CampaignLevel1TerritoryId']])->with('success','Level 2 Territory updated successfully.');
    }
    
}
