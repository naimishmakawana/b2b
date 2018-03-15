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
           
                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Contact Person Name</th>
                                            <th>Contact Person Email</th>
                                            <th>Contact Person Designation</th>
                                            <th class="disabled-sorting text-center">Actions</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($B2BCustomers as $B2BCustomer)
                                        <tr id="row_{{$B2BCustomer->CustomerId}}">
                                            <td>{{$B2BCustomer->NameOfOrganization}}</td>
                                            <td>{{$B2BCustomer->ContactPersonFirstName}} {{$B2BCustomer->ContactPersonLastName}}</td>
                                            <td>{{$B2BCustomer->ContactPersonEmailAddress}}</td>
                                            <td>{{$B2BCustomer->ContactPersonDesignation}}</td>
                                            
                                             <td class="text-center"><a href="{{URL::to('/TagCampaignSelection')}}?id=<?=$B2BCustomer->CustomerId?>">Next Step</a></td>
                                           
                                            
                                            <td class="text-center">
                                               <input type="checkbox" name="B2BCustomerStatus" id="{{$B2BCustomer->CustomerId}}"  <?=($B2BCustomer->ActiveStatus==1)?"checked":""?> value="{{$B2BCustomer->CustomerId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteCustomer({{$B2BCustomer->CustomerId}})" href="#"><i class="material-icons">close</i></a>
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