<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level1Territory;

class Level1TerritoryController extends Controller
{
    public function index()
    {
        $Level1Territory = Level1Territory::where('IsDelete','0')->latest()->get();
        return view('Level1Territory.index',compact('Level1Territory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        if(isset($_GET['camid']) && !empty($_GET['camid']))
        {
            return view('Level1Territory.create',[
                'camid' => $_GET['camid']
            ]);
        } else {
            return view('Level1Territory.create');
        }
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
            'Level1TerritoryName' => 'required|unique:Level1Territory,Level1TerritoryName,NULL,Level1TerritoryId,IsDelete,0'
            //'Level1TerritoryName' => 'required|unique:Level1Territory'
        ]);

        //$RequestData = array(); 
       // $RequestData['Level1TerritoryName'] = $Request['Level1TerritoryName'];

        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        Level1Territory::create($Request->all());

        if(isset($Request['CampaignId']) && $Request['CampaignId'] != '') {
            return redirect()->route('CampaignsTerritoriesStep2.index',['id'=>$Request['CampaignId']])->with('success','Level 1 territory created successfully.');
        } else {
            return redirect()->route('Territory1Territory2Step1.index',['id'=>$Request['B2BCustomerId']])->with('success','Level 1 territory created successfully.');
        }
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Level1Territory $Level1Territory)
    {
        if(isset($_GET['camid']) && !empty($_GET['camid']))
        {
            return view('Level1Territory.edit',compact('Level1Territory'),[
                'camid' => $_GET['camid']
            ]);
        } else {
            return view('Level1Territory.edit',compact('Level1Territory'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $Request,Level1Territory $Level1Territory)
    { 
        request()->validate([
             'Level1TerritoryName' => 'required|unique:Level1Territory,Level1TerritoryName,'.$Level1Territory['Level1TerritoryId'].',Level1TerritoryId,IsDelete,0'
        ]);

        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        $Level1Territory->update($Request->all());

        if(isset($Request['CampaignId']) && $Request['CampaignId'] != '') {
            return redirect()->route('CampaignsTerritoriesStep2.index',['id'=>$Request['CampaignId']])->with('success','Level 1 territory updated successfully.');
        } else {
            return redirect()->route('Territory1Territory2Step1.index',['id'=>$Request['B2BCustomerId']])->with('success','Level 1 territory updated successfully.');
        }
    }
    
}
