<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level1Territory;
use App\B2BCustomer;
use App\Level1TerritoriesLevel2Territories;

class Level1TerritoriesLevel2TerritoriesStep1Controller extends Controller
{
    public function index()
    {
        $CustomerId = $_GET['id'];

        $B2BCustomer = B2BCustomer::where('CustomerId',$CustomerId)->first();

        $Level1Territories = Level1Territory::select("B2BCustomer.NameOfOrganization","Level1Territory.*")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'Level1Territory.B2BCustomerId')
        ->where('B2BCustomer.CustomerId',$CustomerId)
        ->where('Level1Territory.IsDelete','0')
        ->latest()
        ->get();

        return view('Level1TerritoriesLevel2TerritoriesStep1.index',compact('Level1Territories'))
            ->with('NameOfOrganization', $B2BCustomer->NameOfOrganization)
            ->with('CustomerId', $B2BCustomer->CustomerId);
    }

    public function ChangeStatusToLevel1Territory(Request $Request, Level1Territory $Level1Territory)
    {
        if(isset($Request['Level1TerritoryId'])){   
              Level1Territory::where('Level1TerritoryId',$Request['Level1TerritoryId'])->update( array(
                 'ActiveStatus' => $Request['ActiveStatus']
              ));
        }
    }

    public function DeleteLevel1Territory(Request $Request, Level1Territory $Level1Territory)
    {
        if(isset($Request['Level1TerritoryId'])){

              $Level1Territory->where('Level1TerritoryId',$Request['Level1TerritoryId'])->update(['IsDelete' => 1]);
        }
 
    }

}
