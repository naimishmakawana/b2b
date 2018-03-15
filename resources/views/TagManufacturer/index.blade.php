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
                         <div class="col-md-10 card-header card-header-text">
                            <h4 class="card-title">Tag Manufacturer</h4>
                           
                        </div>
                         <div class="col-md-2">
                             <a style="float: right;" href="{{ url('TagManufacturer/create') }}" class="btn btn-primary btn-sm">Create New Tag Manufacturer</a>
                        </div>
                         </div>
                    </div>

                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Manufacturer Name</th>
                                            <th>Contact Person Name</th>
                                            <th>Contact Person Email</th>
                                            <th>Contact Person Designation</th>
                                            <th>Contact Person TelNumber</th>
                                            <th class="disabled-sorting text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Manufacturer Name</th>
                                            <th>Contact Person Name</th>
                                            <th>Contact Person Email</th>
                                            <th>Contact Person Designation</th>
                                            <th>Contact Person TelNumber</th>
                                            <th class="disabled-sorting text-center">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach ($TagManufacturer as $value)
                                        <tr>
                                            <td>{{$value->ManufacturerName}}</td>
                                            <td>{{$value->ContactPersonFirstName}} {{$value->ContactPersonLastName}}</td>
                                            <td>{{$value->ContactPersonEmailAddress}}</td>
                                            <td>{{$value->ContactPersonDesignation}}</td>
                                            <td>{{$value->ContactPersonTelNumber}}</td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('TagManufacturer.edit',$value->TagManufacturerId) }}"><i class="material-icons">dvr</i></a>
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

    {!! $TagManufacturer->render() !!}


      
@endsection