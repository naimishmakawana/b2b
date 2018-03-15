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
                                <b>B2B Customer Name : {{$NameOfOrganization}}</b>
                         </div>
                    </div>

                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>B2B Customer Name</th>
                                            <th>Tag Groups</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($CustomerTagmanufacturers as $CustomerTagmanufacturer)
                                        <tr id="row_{{$CustomerTagmanufacturer->TagManufacturerId}}">
                                            <td>{{$CustomerTagmanufacturer->NameOfOrganization}}</td>
                                            <td>{{$CustomerTagmanufacturer->ManufacturerName}}</td>
                                            <td class="text-center">
                                               <input type="checkbox" name="TagManufacturerStatus" id="{{$CustomerTagmanufacturer->TagManufacturerId}}"  <?=($CustomerTagmanufacturer->ActiveStatus==1)?"checked":""?> value="{{$CustomerTagmanufacturer->TagManufacturerId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('TagManufacturer.edit',$CustomerTagmanufacturer->TagManufacturerId) }}?id=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>
                                             <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon" onclick="OnRemoveTagManufacturerFromCustomer({{$CustomerTagmanufacturer->CustomerTagManufacturerId}})" href="#"><i class="material-icons dp48">remove_circle</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>

                            <br />
                           
                            <div class="col-md-12" style="text-align: center;"> 
                                 <a  href="{{ url('TagManufacturer/create') }}?id=<?=$B2BCustomerId?>" class="btn btn-primary btn">Create New Tag Manufacturer</a>
                            </div>

                            <div class="row" style="text-align: center;"> 
                                 <div class="col-md-12">
                                        <b>Available Tag Manufacturers </b>
                                 </div>
                            </div>


                            <div class="card-content">
                            <div class="material-datatables">
                                <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tag Groups</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                            <th class="disabled-sorting text-center">Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($AvailableCustomerTagmanufacturers as $AvailableCustomerTagmanufacturer)
                                        <tr id="row_{{$AvailableCustomerTagmanufacturer->TagManufacturerId}}"> 
                                            <td>{{$AvailableCustomerTagmanufacturer->ManufacturerName}}</td>
                                            <td class="text-center">
                                               <input type="checkbox" name="TagManufacturerStatus" id="{{$AvailableCustomerTagmanufacturer->TagManufacturerId}}"  <?=($AvailableCustomerTagmanufacturer->ActiveStatus==1)?"checked":""?> value="{{$AvailableCustomerTagmanufacturer->TagManufacturerId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('TagManufacturer.edit',$AvailableCustomerTagmanufacturer->TagManufacturerId) }}?id=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteTagManufacturer({{$AvailableCustomerTagmanufacturer->TagManufacturerId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                              <td class="text-center">
                                                <a class="btn btn-simple btn-success btn-icon remove" onclick="OnAddTagManufacturerInCustomer({{$AvailableCustomerTagmanufacturer->TagManufacturerId}},{{$B2BCustomerId}})" href="#"><i class="material-icons dp48">add_circle</i></a>
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
                <div class="modal-content" id="CatProductsModal">
                    
                </div>
            </div>
        </div>                   

 


      
@endsection