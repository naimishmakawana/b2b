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
           
                    <br />
                    
                    <div class="row" style="text-align: center;"> 
                         <div class="col-md-12">
                                <b>Campaign Name : {{$CampaignName}}</b>
                         </div>
                    </div>

                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>L1 Territory Name</th>
                                            <th>L1 Territory No</th>
                                            <th class="disabled-sorting text-center">Campaigns</th> 
                                            <th>Target Url</th>
                                            <th>Level 2 Territories</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                            <th class="disabled-sorting text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($Level1Territories as $Level1Territory)
                                        <tr id="row_{{$Level1Territory->Level1TerritoryId}}">
                                            <td>{{$Level1Territory->NameOfOrganization}}</td>
                                            <td>{{$Level1Territory->Level1TerritoryId}}</td>
                                            <td>{{$Level1Territory->Level1TerritoryName}}</td>
                                            <td class="text-center"><a href="#" data-toggle="modal" data-target=".example-modal-lg" onclick="ViewCampaignsByLevel1Territory({{$Level1Territory->Level1TerritoryId}})">View</a></td>

                                            <td><input type="text" onchange="SaveL1TerritoryTargetUrl({{$Level1Territory->CampaignLevel1TerritoryId}},this.value, {{$Level1Territory->Level1TerritoryId}})" value="{{$Level1Territory->TargetURL}}" onfocusout="SaveL1TerritoryTargetUrl({{$Level1Territory->CampaignLevel1TerritoryId}},this.value, {{$Level1Territory->Level1TerritoryId}})" value="{{$Level1Territory->TargetURL}}"></td>
                                            <td>
                                                <a id="2TerritoryLink{{$Level1Territory->Level1TerritoryId}}" href="CampaignsTerritoriesStep4?id={{$Level1Territory->CampaignLevel1TerritoryId}}" style="<?=empty($Level1Territory->TargetURL)?"display: block;":"display: none;";?>">Add / Remove</a>
                                                
                                            </td>
                                        
                                            <td class="text-center">
                                               <input type="checkbox" name="Level1TerritoryStatus" id="{{$Level1Territory->Level1TerritoryId}}"  <?=($Level1Territory->ActiveStatus==1)?"checked":""?> value="{{$Level1Territory->Level1TerritoryId}}">
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('Level1Territory.edit',$Level1Territory->Level1TerritoryId) }}?camid=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteLevel1Territory({{$Level1Territory->Level1TerritoryId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                             <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon" onclick="OnRemoveLevel1TerritoryFromCampaign({{$Level1Territory->CampaignLevel1TerritoryId}})" href="#"><i class="material-icons dp48">remove_circle</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>

                            <br />
                           
                            <div class="col-md-12" style="text-align: center;"> 
                                 <a  href="{{ url('Level1Territory/create') }}?id=<?=$B2BCustomerId;?>&camid=<?=$CampaignId?>" class="btn btn-primary btn">Create New Level 1 Territory</a>
                            </div>

                            <div class="row" style="text-align: center;"> 
                                 <div class="col-md-12">
                                        <b>Available Level 1 Territories</b>
                                 </div>
                            </div>


                            <div class="card-content">
                            <div class="material-datatables">
                                <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="disabled-sorting text-center">Associated Campaigns</th>
                                            <th>Level 1 Territory No</th>
                                            <th>Level 1 Territory Name</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            @if (!isset($_GET['flag']))
                                                <th class="disabled-sorting text-center">Edit</th>
                                            @endif

                                            <th class="disabled-sorting text-center">Deactive</th>
                                            <th class="disabled-sorting text-center">Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($AvailableLevel1Territories as $AvailableLevel1Territory)
                                        <tr id="row_{{$AvailableLevel1Territory->Level1TerritoryId}}"> 
                                             <td class="text-center"><a href="#" data-toggle="modal" data-target=".example-modal-lg" onclick="ViewCampaignsByLevel1Territory({{$AvailableLevel1Territory->Level1TerritoryId}})">View</a></td>
                                            <td>{{$AvailableLevel1Territory->Level1TerritoryId}}</td>
                                            <td>{{$AvailableLevel1Territory->Level1TerritoryName}}</td>
                                            <td class="text-center">
                                               <input type="checkbox" name="Level1TerritoryStatus" id="{{$AvailableLevel1Territory->Level1TerritoryId}}"  <?=($AvailableLevel1Territory->ActiveStatus==1)?"checked":""?> value="{{$AvailableLevel1Territory->Level1TerritoryId}}">
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('Level1Territory.edit',$AvailableLevel1Territory->Level1TerritoryId) }}?camid=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteLevel1Territory({{$AvailableLevel1Territory->Level1TerritoryId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                              <td class="text-center">
                                                <a class="btn btn-simple btn-success btn-icon remove" onclick="OnAddLevel1TerritoryInCampaign({{$AvailableLevel1Territory->Level1TerritoryId}},{{$CampaignId}})" href="#"><i class="material-icons dp48">add_circle</i></a>
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
            <div class="modal-content" id="CamTerL1Modal">
                
            </div>
        </div>
    </div>                    

      
@endsection