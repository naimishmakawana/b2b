@extends('layouts.b2b')
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    

    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
           
                    <div class="row"> 
                         <div class="col-md-12">
                             <div style="text-align: center;" class="col-md-12 card-header card-header-text">
                                <h4 class="card-title">B2B Customer Name:  {{$NameOfOrganization}}</h4>
                             </div> 
                         </div>
                    </div>

                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Campaign Name</th>
                                            <th class="text-center">View Associated Tags</th>
                                            <th class="text-center">Without Territory</th>
                                            <th class="text-center">With Territory</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($B2BCustomerCampaigns as $B2BCustomerCampaign)
                                        <tr id="row_{{$B2BCustomerCampaign->CampaignId}}">
                                            <td>{{$B2BCustomerCampaign->NameOfOrganization}}</td>
                                            <td>{{$B2BCustomerCampaign->CampaignName}}</td>
                                            
                                            <td class="text-center"><a href="#" data-toggle="modal" data-target=".example-modal-lg" onclick="ViewTagCampaignInTags({{$B2BCustomerCampaign->CampaignId}})">View</a>
                                            </td>
                                            <td class="text-center">
                                                @if (($B2BCustomerCampaign->IsNFCTagFoundINTer) == 0)
                                                    <a href="{{URL::to('/CampaignTagsStep3')}}?id=<?=$B2BCustomerCampaign->CampaignId?>">Add / Remove Tag</a>
                                                 @endif
                                            </td>
                                            <td class="text-center">
                                                 @if (($B2BCustomerCampaign->IsNFCTagFoundINCmp) == 0)
                                                    <a href="{{URL::to('/TagLevel1TerritorySelection')}}?id=<?=$B2BCustomerCampaign->CampaignId?>">Level 1 Territory</a>
                                                @endif
                                            </td>
                                           
                                            <td class="text-center">
                                               <input type="checkbox" name="B2BCampaignStatus" id="{{$B2BCustomerCampaign->CampaignId}}"  <?=($B2BCustomerCampaign->ActiveStatus==1)?"checked":""?> value="{{$B2BCustomerCampaign->CampaignId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteCampaign({{$B2BCustomerCampaign->CampaignId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                    </div>
                </div>
        </div>
      </div>                      

       <div class="modal fade example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="TagBundleL1Modal">
                
            </div>
        </div>
    </div>   
      
@endsection