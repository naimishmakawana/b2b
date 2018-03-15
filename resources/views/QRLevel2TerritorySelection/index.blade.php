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
                                <b>Level 1 Territory Name : {{$Level1TerritoryName}}</b>
                         </div>
                    </div>

                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Campaign Name </th>
                                            <th>L2 Territory No</th>
                                            <th>L2 Territory Name</th>
                                            <th class="disabled-sorting text-center">Campaigns</th> 
                                            <th>Target Url</th>
                                            <th class="text-center">ORCode</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                            <th class="disabled-sorting text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($Level2Territories as $Level2Territory)
                                        <tr id="row_{{$Level2Territory->Level2TerritoryId}}">
                                            <td>{{$Level2Territory->NameOfOrganization}}</td>
                                            <td>{{$Level2Territory->CampaignName}}</td>
                                            <td>{{$Level2Territory->Level2TerritoryId}}</td>
                                            <td>{{$Level2Territory->Level2TerritoryName}}</td>
                                            <td class="text-center"><a href="#" data-toggle="modal" data-target=".example-modal-lg" onclick="ViewCampaignL1TerByCampaignL2Ter({{$Level2Territory->Level2TerritoryId}})">View</a></td>

                                            <td><input type="text" onchange="SaveL2TerritoryTargetUrl({{$Level2Territory->CampaignLevel2TerritoryId}},this.value)" value="{{$Level2Territory->TargetURL}}" onfocusout="SaveL2TerritoryTargetUrl({{$Level2Territory->CampaignLevel2TerritoryId}},this.value)" value="{{$Level2Territory->TargetURL}}"></td>
                                           
                                            </td>
                                           
                                             <td class="text-center">
                                                 @if($CampaignLevel2TerritoryId == $Level2Territory->CampaignLevel2TerritoryId || $CampaignLevel2TerritoryId == 0)
                                                    <a href="#" data-toggle="modal" data-target=".qrmodal" onclick="ViewCampaignInQRCodes({{$B2BCustomerId}},{{$Level2Territory->CampaignId}},{{$CampaignLevel1TerritoryId}},{{$Level2Territory->CampaignLevel2TerritoryId}})"> <?=($Level2Territory->QRCodeFileName!=NULL)?"(".$Level2Territory->QRCodeFileName.") <a class='btn btn-simple btn-danger btn-icon' onclick='OnRemoveQRCodeInCampaign(".$Level2Territory->QRCodeId.",".$Level2Territory->CampaignId.",".$CampaignLevel1TerritoryId.",".$Level2Territory->CampaignLevel2TerritoryId.")' href='#''><i class='material-icons dp48'>remove_circle</i></a>":'Add';?></a>
                                                    @endif
                                                  
                                            </td>
                                            
                                            <td class="text-center">
                                               <input type="checkbox" name="Level2TerritoryStatus" id="{{$Level2Territory->Level2TerritoryId}}"  <?=($Level2Territory->ActiveStatus==1)?"checked":""?> value="{{$Level2Territory->Level2TerritoryId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteLevel2Territory({{$Level2Territory->Level2TerritoryId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                             <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon" onclick="OnRemoveCampaignL1TerFromCampaignL1Ter({{$Level2Territory->CampaignLevel2TerritoryId}})" href="#"><i class="material-icons dp48">remove_circle</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>

                            <br />
                           
                            <div class="row" style="text-align: center;"> 
                                 <div class="col-md-12">
                                        <b>Available Level 2 Territories</b>
                                 </div>
                            </div>


                            <div class="card-content">
                            <div class="material-datatables">
                                <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="disabled-sorting text-center">Associated Campaigns</th>
                                            <th>Level 2 Territory No</th>
                                            <th>Level 2 Territory Name</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                            <th class="disabled-sorting text-center">Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($AvailableLevel2Territories as $AvailableLevel2Territory)
                                        <tr id="row_{{$AvailableLevel2Territory->Level2TerritoryId}}"> 
                                             <td class="text-center"><a href="#" data-toggle="modal" data-target=".example-modal-lg" onclick="ViewCampaignL1TerByCampaignL2Ter({{$AvailableLevel2Territory->Level2TerritoryId}})">View</a></td>
                                            <td>{{$AvailableLevel2Territory->Level2TerritoryId}}</td>
                                            <td>{{$AvailableLevel2Territory->Level2TerritoryName}}</td>
                                            <td class="text-center">
                                               <input type="checkbox" name="Level2TerritoryStatus" id="{{$AvailableLevel2Territory->Level2TerritoryId}}"  <?=($AvailableLevel2Territory->ActiveStatus==1)?"checked":""?> value="{{$AvailableLevel2Territory->Level2TerritoryId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteLevel2Territory({{$AvailableLevel2Territory->Level2TerritoryId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                              <td class="text-center">
                                                <a class="btn btn-simple btn-success btn-icon remove" data-toggle="modal" data-target=".example-modal-lg2" onclick="SetTerritory2Data({{$AvailableLevel2Territory->Level2TerritoryId}},{{$CampaignLevel1TerritoryId}})" href="#"><i class="material-icons dp48">add_circle</i></a>
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

     <div class="modal fade example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="CamTerL1Modal">
          
               {!! Form::open(array('route' => 'AddCampaignL1TerFromCampaignL1Ter','method'=>'POST', 'class'=>'form-horizontal', 'id'=>'b2bcustomer_product')) !!}

                <input type="hidden" name="flag" value="qrcode" />
                
                <div class="modal-header">
                    <h4 class="modal-title"><b>Add Target URL</b></h4>
                </div>
                <div class="modal-body">
                   
                         <div class="col-sm-12">
                            <div class="form-group label-floating">
                                <label class="control-label"></label>
                                <input class="form-control" type="hidden" name="Level2TerritoryId" id="Level2TerritoryId" required="true" />
                                <input class="form-control" type="hidden" name="CampaignLevel1TerritoryId" id="CampaignLevel1TerritoryId" required="true" />
                                <input class="form-control" type="text" name="TargetURL" required="true" />
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Save</button>
                </div>

                </form>

            </div>
        </div>
    </div>   

    <div class="modal fade .example-modal-lg qrmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="QRCodeL1Modal">
                
            </div>
        </div>
    </div>                           

      
@endsection