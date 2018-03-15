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
                         <div class="col-md-12" style="text-align: center;"> 
                             <a  href="{{ url('Level1Territory/create') }}?id=<?=$CustomerId?>" class="btn btn-primary btn">Create Level 1 Territory</a>
                        </div>
                         </div>
                    </div>

                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Level 1 Territory Name</th>
                                            <th>Level 2 Territories</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($Level1Territories as $Level1Territory)
                                        <tr id="row_{{$Level1Territory->Level1TerritoryId}}">
                                            <td>{{$Level1Territory->NameOfOrganization}}</td>
                                            <td>{{$Level1Territory->Level1TerritoryName}}</td>
                                            <td> <a href="{{URL::to('/Territory1Territory2Step2')}}?id=<?=$Level1Territory->Level1TerritoryId?>">Add / Remove</a></td>
                                            <td class="text-center">
                                               <input type="checkbox" name="Level1TerritoryStatus" id="{{$Level1Territory->Level1TerritoryId}}"  <?=($Level1Territory->ActiveStatus==1)?"checked":""?> value="{{$Level1Territory->Level1TerritoryId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('Level1Territory.edit',$Level1Territory->Level1TerritoryId) }}?id=<?=$CustomerId?>"><i class="material-icons">dvr</i></a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteLevel1Territory({{$Level1Territory->Level1TerritoryId}})" href="#"><i class="material-icons">close</i></a>
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

      
@endsection