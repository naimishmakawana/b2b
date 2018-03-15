<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomer;
use App\NFCTag;
use DB;

class NFCTagsRollManagementController extends Controller
{
    public function index(Request $Request)
    {
        $RollRawQuery = "SELECT * FROM 
        (SELECT OriginatingRollId,Count(*) AS tot FROM NFCTag  GROUP BY OriginatingRollId ) total LEFT JOIN (SELECT ManufacturerName,OriginatingRollId,Count(*) AS Available,MIN(CMSSequence) AS StartSequence,MAX(CMSSequence) AS EndSequence, NFCTagId 
        FROM NFCTag 
        JOIN TagManufacturer ON NFCTag.TagManufacturerId = TagManufacturer.TagManufacturerId 
        WHERE TagBundleId IS NULL 
        GROUP BY ManufacturerName,OriginatingRollId ) unassigned ON ( total.OriginatingRollId = unassigned.OriginatingRollId) 
        ORDER BY unassigned.OriginatingRollId";

        $TagRolls = DB::select(DB::raw($RollRawQuery));

        $B2BCustomers = B2BCustomer::where('IsDelete','0')->get();

    
        $TagRollsHistory = NFCTag::select("NFCTag.*","TagManufacturer.ManufacturerName","B2BCustomer.NameOfOrganization",DB::raw("count(*) as NumberofTags"))
                ->join('B2BCustomer', 'NFCTag.B2BCustomerId', '=', 'B2BCustomer.CustomerId')
                ->join('TagManufacturer', 'NFCTag.TagManufacturerId', '=', 'TagManufacturer.TagManufacturerId')
                ->where('NFCTag.IsAssigned','1')
                ->groupBy('TagBundleId')
                ->orderBy('NFCTag.ModifyAt','desc')
                ->get();

        return view('NFCTagsRollManagement.index',compact('TagRolls','B2BCustomers','TagRollsHistory'));
           
    }

    public function store(Request $Request)
    { 

        request()->validate([
            'NFCTagId' => 'required',
            'B2BCustomerId' => 'required',
            'RollNo' => 'required',
            'StartingSequenceNo' => 'required',
            'EndingSequenceNo' => 'required',
            'ManufacturerName' => 'required',
            'NumberOfTags' => 'required'
        ]);

        if(($Request['StartingSequenceNo'] + $Request['NumberOfTags']) > $Request['sq_end_'.$Request['NFCTagId']])
        {
            return redirect()->route('NFCTagsRollManagement.index')->with('fail','Invalid Number Of Tags.');
        }

        $rollNumber = $Request['RollNo'];//'17_7299-01';       //Variable to hold the Selected Roll Number
        $startSequenceNumber = $Request['StartingSequenceNo']; //'0000000071'; //Variable to hold the selected Roll Starting sequence Number
        $bundleSequenceNumber = ($Request['TagBundleId'] == NULL?0:$Request['TagBundleId']);    //0;  //Variable to hold the Bundle Id

        $numberOfTags = $Request['NumberOfTags'];           //10; //Variable to hold the entered Tag Numbers

        $greatestBundleNumber = NFCTag::where('OriginatingRollId', '=',$rollNumber)->max('BundleSequenceNumber');
        

       /* $greatestBundleNumber = "SELECT MAX(BundleSequenceNumber) from NFCTag where OriginatingRollId = '".$rollNumber."'";
        $greatestBundleNumber = DB::select($greatestBundleNumber);*/

        if($greatestBundleNumber != NULL || $greatestBundleNumber == 0)
        {
            $bundleSequenceNumber = $greatestBundleNumber + 1;
        }

        $bundleId = $rollNumber . '-' . 'Bundle' .  $bundleSequenceNumber;

        /*$updateResult = NFCTag::where('OriginatingRollId',$rollNumber)
                ->where("CAST(CMSSequence AS UNSIGNED)",'>=',$startSequenceNumber)
                ->orderBy('CMSSequence','asc')
                ->limit($numberOfTags)
                ->update(['TagBundleId' => $bundleId,
                          'BundleSequenceNumber' => $bundleSequenceNumber,
                          'IsAssigned'=> 1]);*/

        $updateResult = "UPDATE NFCTag SET B2BCustomerId = '".$Request['B2BCustomerId']."', TagBundleId = '".$bundleId."', BundleSequenceNumber = '".$bundleSequenceNumber."', IsAssigned=1 Where OriginatingRollId = '".$rollNumber."' and CAST(CMSSequence AS UNSIGNED) >= '".$startSequenceNumber."' order by CMSSequence asc limit ".$numberOfTags."";

        $TagRolls = DB::update($updateResult);

        
        NFCTag::where('BundleSequenceNumber',0)->update(['BundleSequenceNumber' => NULL]);

        return redirect()->route('NFCTagsRollManagement.index',['NFCTagId'=>$Request->NFCTagId])->with('success','Tag assigned successfully.');


    }

    public function OnSelectNFCTag(Request $Request)
    { 
        $NFCTagId = $Request['NFCTagId'];
        $NFCTag = NFCTag::select("NFCTag.OriginatingRollId","NFCTag.TagBundleId","TagManufacturer.ManufacturerName")
        ->join('TagManufacturer', 'NFCTag.TagManufacturerId', '=', 'TagManufacturer.TagManufacturerId')
        ->where('NFCTag.NFCTagId',$NFCTagId)
        ->where('NFCTag.IsDelete','0')
        ->first();

        echo json_encode($NFCTag);
    }
    
}
