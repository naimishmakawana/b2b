<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomerCampaign;
use App\B2BCustomer;
use App\CampaignSequentialTaps;
use DB;

class B2BCustomerCampaignController extends Controller
{
    public function index()
    {
        $B2BCustomerCategories = B2BCustomerCampaign::where('IsDelete','0')->latest()->get();
        return view('B2BCustomerCampaign.index',compact('B2BCustomerCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $CustomerId = $_GET['id'];

        return view('B2BCustomerCampaign.create',[
            'B2BCustomer' => B2BCustomer::where('CustomerId',$CustomerId)->first(),
            'flag'  => $_GET['flag']
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
             'CampaignName' => 'required|unique:B2BCustomerCampaign,CampaignName,NULL,CampaignId,IsDelete,0',
             'CampaignObjective' => 'required',
             'CampaignStartDate' => 'required',
             'CampaignEndDate' => 'required',
             'RedirectURL' => 'required',
             'EndDateRedirectURL' => 'required'
        ]);
        
        $Request['CampaignStartDate'] = date('Y-m-d H:i:s',strtotime($Request['CampaignStartDate']));
        $Request['CampaignEndDate'] = date('Y-m-d H:i:s',strtotime($Request['CampaignEndDate']));
        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;   
        $Request['Repeat'] = isset($Request['Repeat']) ? 1 : 0;    
        $Campaign = B2BCustomerCampaign::create($Request->all());

        foreach ($Request->TapRedirectURL as $RedirectURL)
        {
            if($RedirectURL != '')
                $data[] = array('CampaignId' => $Campaign->CampaignId, 'RedirectURL' => $RedirectURL);
        }
        CampaignSequentialTaps::insert($data);

        return redirect()->route('CampaignsProductsStep1.index',['id'=>$Request['B2BCustomerId'],'flag'=>$Request['flag']])->with('success','B2B customer campaign created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(B2BCustomerCampaign $B2BCustomerCampaign)
    {
        return view('B2BCustomerCampaign.show',compact('B2BCustomerCampaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(B2BCustomerCampaign $B2BCustomerCampaign)
    {
        $B2BCustomerId = $B2BCustomerCampaign->B2BCustomerId;
        $CampaignId = $B2BCustomerCampaign->CampaignId;
       
        return view('B2BCustomerCampaign.edit',compact('B2BCustomerCampaign'),[
            'B2BCustomer' => B2BCustomer::where('CustomerId',$B2BCustomerId)->first(),
            'CampaignSequentialTaps' => CampaignSequentialTaps::where('CampaignId',$CampaignId)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $Request,B2BCustomerCampaign $B2BCustomerCampaign)
    {
        //'CategoryName' => 'required|unique:B2BCustomerCategory,CategoryName,NULL,CategoryId,IsDelete,0'
        request()->validate([
            'CampaignName' => 'required|unique:B2BCustomerCampaign,CampaignName,'.$B2BCustomerCampaign['CampaignId'].',CampaignId,IsDelete,0',
            'CampaignObjective' => 'required',
            'CampaignStartDate' => 'required',
            'CampaignEndDate' => 'required',
            'RedirectURL' => 'required',
            'EndDateRedirectURL' => 'required'
        ]);
   
        $Request['CampaignStartDate'] = date('Y-m-d H:i:s',strtotime($Request['CampaignStartDate']));
        $Request['CampaignEndDate'] = date('Y-m-d H:i:s',strtotime($Request['CampaignEndDate']));
        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;   
        $Request['Repeat'] = isset($Request['Repeat']) ? 1 : 0;    

        $B2BCustomerCampaign->update($Request->all());

        foreach ($Request->TapRedirectURL as $key => $RedirectURL)
        {
            if($RedirectURL != '')
            {
                $CampaignSequentialTapId = isset($Request['CampaignSequentialTapId'][$key])?$Request['CampaignSequentialTapId'][$key]:0;
                CampaignSequentialTaps::updateOrCreate(['CampaignSequentialTapId' => $CampaignSequentialTapId], 
                    [ 
                        'CampaignId' => $B2BCustomerCampaign['CampaignId'],
                        'RedirectURL' => $RedirectURL
                    ]
                );
            }
        }
        
        return redirect()->route('CampaignsProductsStep1.index',['id'=>$B2BCustomerCampaign['B2BCustomerId'],'flag'=>$Request['flag']])->with('success','B2B customer campaign updated successfully.');
    }
    
}
