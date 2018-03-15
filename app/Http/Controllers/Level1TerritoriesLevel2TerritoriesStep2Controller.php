<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level2Territory;
use App\Level1Territory;
use App\Level1TerritoryLevel2Territories;

class Level1TerritoriesLevel2TerritoriesStep2Controller extends Controller
{
    public function index()
    {
        $Level2TerritoryArr = array();

        $Level1TerritoryId = $_GET['id'];

        $Level1Territory = Level1Territory::where('Level1TerritoryId',$Level1TerritoryId)->first();
        $B2BCustomerId =  $Level1Territory['B2BCustomerId'];
        $Level1TerritoryName =  $Level1Territory['Level1TerritoryName'];

        $Level2Territories = Level2Territory::select("B2BCustomer.NameOfOrganization","Level2Territory.*","Level1TerritoryLevel2Territories.Level1TerritoryLevel2TerritoryId","Level1Territory.Level1TerritoryName","Level1Territory.Level1TerritoryId")
        ->leftjoin('Level1TerritoryLevel2Territories', 'Level1TerritoryLevel2Territories.Level2TerritoryId', '=', 'Level2Territory.Level2TerritoryId')
        ->join('Level1Territory', 'Level1Territory.Level1TerritoryId', '=', 'Level1TerritoryLevel2Territories.Level1TerritoryId')
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'Level1Territory.B2BCustomerId')
        ->where('Level1TerritoryLevel2Territories.Level1TerritoryId','=',$Level1TerritoryId)
        ->where('Level2Territory.IsDelete','0')
        ->latest()
        ->get();

        foreach ($Level2Territories as $key => $value) {
            $Level2TerritoryArr[] = $value['Level2TerritoryId'];
        }

        $AvailableLevel2Territories = Level2Territory::select("Level2Territory.*")
        //->leftjoin('Level1TerritoryLevel2Territories', 'Level1TerritoryLevel2Territories.Level2TerritoryId', '=', 'Level2Territory.Level2TerritoryId')
        ->whereNotIn('Level2Territory.Level2TerritoryId', $Level2TerritoryArr)
        ->where('Level2Territory.IsDelete','0')
        ->latest()
        ->get();

        return view('Level1TerritoriesLevel2TerritoriesStep2.index',compact('Level2Territories'),compact('AvailableLevel2Territories'))
            ->with('Level1TerritoryName', $Level1TerritoryName)
            ->with('B2BCustomerId', $B2BCustomerId)
            ->with('Level1TerritoryId', $Level1TerritoryId);
        
    }

    public function ChangeStatusToLevel2Territory(Request $Request,Level2Territory $Level2Territory)
    {
        if(isset($Request['Level2TerritoryId'])){   
              Level2Territory::where('Level2TerritoryId',$Request['Level2TerritoryId'])->update( array(
                 'ActiveStatus' => $Request['ActiveStatus']
              ));
        }
    }

    public function DeleteLevel2Territory(Request $Request,Level2Territory $Level2Territory)
    {
        if(isset($Request['Level2TerritoryId'])){

              $Level2Territory->where('Level2TerritoryId',$Request['Level2TerritoryId'])->update(['IsDelete' => 1]);
        }

    }

    public function RemoveLevel2TerritoryFromLevel1Territory(Request $Request)
    {
        if(isset($Request['Level1TerritoryLevel2TerritoryId'])){
              $todo = Level1TerritoryLevel2Territories::findOrFail($Request['Level1TerritoryLevel2TerritoryId']);
              $todo->delete();
        } 
    }

    public function AddLevel2TerritoryInLevel1Territory(Request $Request)
    {
        Level1TerritoryLevel2Territories::create($Request->all());
    }

}
