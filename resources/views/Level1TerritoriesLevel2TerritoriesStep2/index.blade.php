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
                                            <th>Level 1 Territory Name</th>
                                            <th>Level 2 Territory Number</th>
                                            <th>Level 2 Territory Name</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                            <th class="disabled-sorting text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($Level2Territories as $Level2Territory)
                                        <tr id="row_{{$Level2Territory->Level2TerritoryId}}">
                                            <td>{{$Level2Territory->NameOfOrganization}}</td>
                                            <td>{{$Level2Territory->Level1TerritoryName}}</td>
                                            <td>{{$Level2Territory->Level2TerritoryId}}</td>
                                            <td>{{$Level2Territory->Level2TerritoryName}}</td>
                                            <td class="text-center">
                                               <input type="checkbox" name="Level2TerritoryStatus" id="{{$Level2Territory->Level2TerritoryId}}"  <?=($Level2Territory->ActiveStatus==1)?"checked":""?> value="{{$Level2Territory->Level2TerritoryId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('Level2Territory.edit',$Level2Territory->Level2TerritoryId) }}?terid=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteLevel2Territory({{$Level2Territory->Level2TerritoryId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                             <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon" onclick="OnRemoveLevel2TerritoryFromLevel1Territory({{$Level2Territory->Level1TerritoryLevel2TerritoryId}})" href="#"><i class="material-icons dp48">remove_circle</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>

                            <br />
                           
                            <div class="col-md-12" style="text-align: center;"> 
                                 <a  href="{{ url('Level2Territory/create') }}?terid=<?=$Level1TerritoryId?>" class="btn btn-primary btn">Create New Level 2 Territory</a>
                            </div>

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
                                            <th>1 Territory Assigned to 2 Territory</th>
                                            <th>Level 2 Territory Number</th>
                                            <th>Level 2 Territory Name</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                            <th class="disabled-sorting text-center">Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($AvailableLevel2Territories as $AvailableLevel2Territory)
                                        <tr id="row_{{$AvailableLevel2Territory->Level2TerritoryId}}"> 
                                            <td>None</td>
                                            <td>{{$AvailableLevel2Territory->Level2TerritoryId}}</td>
                                             <td>{{$AvailableLevel2Territory->Level2TerritoryName}}</td>
                                            <td class="text-center">
                                               <input type="checkbox" name="Level2TerritoryStatus" id="{{$AvailableLevel2Territory->Level2TerritoryId}}"  <?=($AvailableLevel2Territory->ActiveStatus==1)?"checked":""?> value="{{$AvailableLevel2Territory->Level2TerritoryId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('Level2Territory.edit',$AvailableLevel2Territory->Level2TerritoryId) }}?terid=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteLevel2Territory({{$AvailableLevel2Territory->Level2TerritoryId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                              <td class="text-center">
                                                <a class="btn btn-simple btn-success btn-icon remove" onclick="OnAddLevel2TerritoryInLevel1Territory({{$AvailableLevel2Territory->Level2TerritoryId}},{{$Level1TerritoryId}})" href="#"><i class="material-icons dp48">add_circle</i></a>
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
            <div class="modal-content" id="CatLevel2TerritorysModal">
                
            </div>
        </div>
    </div>                   

      
@endsection