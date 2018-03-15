<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QRCode;
use Illuminate\Support\Facades\Input;
use Image;
use Illuminate\Routing\UrlGenerator;
use App\B2BCustomer;

class QRCodeController extends Controller
{
    public function index()
    {
        $QRCodes = QRCode::where('QRCode.IsDelete','0')
        ->latest()
        ->get();

        return view('QRCode.index',compact('QRCodes'));
           
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('QRCode.create',[
                'B2BCustomers' => B2BCustomer::where('IsDelete','0')->get()
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
            'B2BCustomerId' => 'required',
            'QRCodeImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
            'QRCodeGeneratorName' => 'required',
            'QRCodeFileName' => 'required'
        ]);

        $imageName = rand().time().'.'.request()->QRCodeImage->getClientOriginalExtension(); 
        request()->QRCodeImage->move(public_path('qrcodeimages'), $imageName);
        $Request['QRCodeImageURL'] = $imageName;  // url('/qrcodeimages').'/'.
        
        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;  

        QRCode::create($Request->all());

        if(isset($Request->B2BCustomerIdFromTer))
            return redirect()->route('QRCampaignSelection.index',['id'=>$Request->B2BCustomerIdFromTer])->with('success','QR code created successfully.');
        else if(isset($Request->CampaignId))
            return redirect()->route('QRLevel1TerritorySelection.index',['id'=>$Request->CampaignId])->with('success','QR code created successfully.');
        else if(isset($Request->CampaignLevel1TerritoryId))
            return redirect()->route('QRLevel2TerritorySelection.index',['id'=>$Request->CampaignLevel1TerritoryId])->with('success','QR code created successfully.');
        else
            return redirect()->route('QRCode.index')->with('success','QR code created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(QRCode $QRCode)
    {
        
        $QRCodeId = $QRCode->QRCodeId;
       
        return view('QRCode.edit',[
                'B2BCustomers' => B2BCustomer::where('IsDelete','0')->get()
            ],compact('QRCode'),[
            'QRCode' => QRCode::where('QRCodeId',$QRCodeId)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $Request,QRCode $QRCode)
    {
        request()->validate([
            'B2BCustomerId' => 'required',
            'QRCodeGeneratorName' => 'required'
        ]);

        if(Input::hasFile('QRCodeImage'))
        {
                request()->validate([
                    'QRCodeImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:6048',
                ]);

                $imageName = rand().time().'.'.request()->QRCodeImage->getClientOriginalExtension(); 
                request()->QRCodeImage->move(public_path('qrcodeimages'), $imageName);
                $Request['QRCodeImageURL'] = $imageName; 

                if(isset($Request['OldQRCodeImage']) && $Request['OldQRCodeImage'] != '')
                {
                    unlink(public_path('/qrcodeimages/').$Request['OldQRCodeImage']);
                }
        }
   
        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        $QRCode->update($Request->all());

        return redirect()->route('QRCode.index')->with('success','QR code updated successfully.');
       
    }
    
}
