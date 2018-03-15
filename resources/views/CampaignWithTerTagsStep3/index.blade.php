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
                                            <th>B2B Customer Name</th>
                                            <th class="text-center">Tag Bundle ID</th>
                                            <th class="text-center">Tags</th>
                                            <th class="disabled-sorting text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($CampaignNFCTags as $CampaignNFCTag)
                                        <tr id="row_{{$CampaignNFCTag->NFCTagId}}">
                                            <td>{{$CampaignNFCTag->NameOfOrganization}}</td>
                                            <td class="text-center">{{$CampaignNFCTag->TagBundleId}}</td>
                                            <td class="text-center"><a href="#">Add / Remove</a></td>
                                             <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon" onclick="OnRemoveTagBundleFromL1Territory('{{$CampaignNFCTag->TagBundleId}}',{{$CampaignLevel1TerritoryId}})" href="#"><i class="material-icons dp48">remove_circle</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>

                            <br />
                           
                          <!--   <div class="col-md-12" style="text-align: center;"> 
                                 <a  href="{{ url('NFCTagBundle/create') }}?id=<?=$CampaignLevel1TerritoryId?>" class="btn btn-primary btn">Create New Tag Bundle</a>
                            </div> -->

                            <div class="row" style="text-align: center;"> 
                                 <div class="col-md-12">
                                        <b>Available Tag Bundles</b>
                                 </div>
                            </div>


                            <div class="card-content">
                            <div class="material-datatables">
                                <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tag Bundle ID</th>
                                            <th class="text-center">Manufacturer</th>
                                            <th class="text-center">No. of Available Tags</th>
                                            <th class="text-center">Tags</th>
                                            <th class="text-center">Tags</th>
                                            <th class="disabled-sorting text-center">Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($AvailableCampaignNFCTags as $AvailableCampaignNFCTag)
                                        <tr id="row_{{$AvailableCampaignNFCTag->NFCTagId}}"> 
                                            
                                            <td class="text-center">{{$AvailableCampaignNFCTag->TagBundleId}}</td>
                                            <td class="text-center">{{$AvailableCampaignNFCTag->ManufacturerName}}</td>
                                            <td class="text-center">{{$AvailableCampaignNFCTag->TagCnt}}</td>
                                            <td class="text-center"><a href="#">Add / Remove Tags</a></td>
                                            <td class="text-center"><a href="#" data-toggle="modal" data-target=".example-modal-lg" onclick="ViewTagBundleInTags('{{$AvailableCampaignNFCTag->TagBundleId}}')">View</a></td>
                                              <td class="text-center">
                                                <a class="btn btn-simple btn-success btn-icon remove" onclick="OnAddTagBundleInL1Territory('{{$AvailableCampaignNFCTag->TagBundleId}}',{{$CampaignLevel1TerritoryId}},{{$CampaignId}})" href="#"><i class="material-icons dp48">add_circle</i></a>
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