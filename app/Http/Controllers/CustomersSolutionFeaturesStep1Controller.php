<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SolutionFeature;
use App\B2BCustomer;
use App\CustomerSolutionFeatures;

class CustomersSolutionFeaturesStep1Controller extends Controller
{
    public function index()
    {
        $SolutionFeatureIdArr = array();

        $B2BCustomerId = $_GET['id'];

        $B2BCustomers = B2BCustomer::where('CustomerId',$B2BCustomerId)->first();
        $NameOfOrganization =  $B2BCustomers['NameOfOrganization'];

        $CustomerSolutionFeatures = SolutionFeature::select("B2BCustomer.NameOfOrganization","SolutionFeature.*","CustomerSolutionFeatures.CustomerSolutionFeatureId")
        ->leftjoin('CustomerSolutionFeatures', 'CustomerSolutionFeatures.SolutionFeatureId', '=', 'SolutionFeature.SolutionFeatureId')
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'CustomerSolutionFeatures.B2BCustomerId')
        ->where('CustomerSolutionFeatures.B2BCustomerId','=',$B2BCustomerId)
        ->where('SolutionFeature.IsDelete','0')
        ->latest()
        ->get();

        foreach ($CustomerSolutionFeatures as $CustomerSolutionFeature) {
            $SolutionFeatureIdArr[] = $CustomerSolutionFeature['SolutionFeatureId'];
        }

        $AvailableCustomerSolutionFeatures = SolutionFeature::select("SolutionFeature.*")
        ->whereNotIn('SolutionFeature.SolutionFeatureId', $SolutionFeatureIdArr)
        ->where('SolutionFeature.IsDelete','0')
        ->latest()
        ->get();

        return view('CustomersSolutionFeaturesStep1.index',compact('CustomerSolutionFeatures'),compact('AvailableCustomerSolutionFeatures'))
            ->with('NameOfOrganization', $NameOfOrganization)
            ->with('B2BCustomerId', $B2BCustomerId);
        
    }

    public function ChangeStatusToSolutionFeatures(Request $Request,SolutionFeature $SolutionFeature)
    {
        if(isset($Request['SolutionFeatureId'])){   
              SolutionFeature::where('SolutionFeatureId',$Request['SolutionFeatureId'])->update( array(
                 'ActiveStatus' => $Request['ActiveStatus']
              ));
        }
    }

    public function DeleteSolutionFeatures(Request $Request,SolutionFeature $SolutionFeature)
    {
        if(isset($Request['SolutionFeatureId'])){

              $SolutionFeature->where('SolutionFeatureId',$Request['SolutionFeatureId'])->update(['IsDelete' => 1]);
              
              /*$todo = SolutionFeature::findOrFail($Request['SolutionFeatureId']);
              $todo->delete();

              $todo = CustomerSolutionFeatures::where('SolutionFeatureId',$Request['SolutionFeatureId']);
              $todo->delete();*/
        }

    }

    public function RemoveSolutionFeaturesFromCustomer(Request $Request)
    {
        if(isset($Request['CustomerSolutionFeatureId'])){
              $todo = CustomerSolutionFeatures::findOrFail($Request['CustomerSolutionFeatureId']);
              $todo->delete();
        } 
    }

    public function AddSolutionFeaturesInCustomer(Request $Request)
    {
        CustomerSolutionFeatures::create($Request->all());
    }

}
