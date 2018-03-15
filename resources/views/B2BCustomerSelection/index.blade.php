@extends('layouts.b2b')
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <?php
    if(!isset($_GET['flag']))
    {
        $_GET['flag'] = "catpro";
    }
    ?>

    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
           
                    <div class="row"> 
                         <div class="col-md-12">
                         <!-- <div class="col-md-3 card-header card-header-text">
                            <h4 class="card-title">B2B Customers</h4>
                           
                        </div> -->
                        
                         <div class="col-md-12" style="text-align: center;"> 
                             <a  href="{{ url('B2BCustomer/create') }}?flag=<?=$_GET['flag']?>" class="btn btn-primary btn">Create New B2B Customer</a>
                        </div>
                       
                         </div>
                    </div>

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
                                            <th class="disabled-sorting text-center">Edit</th>
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
                                            @if (($_GET['flag']) == 'catpro')
                                               <td class="text-center"><a href="{{URL::to('/CategoriesProductsStep1')}}?id=<?=$B2BCustomer->CustomerId?>">Next Step</a></td>
                                            @elseif (($_GET['flag']) == 'custag')
                                                <td class="text-center"><a href="{{URL::to('/CustomersTagManufacturersStep1')}}?id=<?=$B2BCustomer->CustomerId?>">Next Step</a></td>
                                            @elseif (($_GET['flag']) == 'cussol')
                                            <td class="text-center"><a href="{{URL::to('/CustomersSolutionFeaturesStep1')}}?id=<?=$B2BCustomer->CustomerId?>">Next Step</a></td>
                                             @elseif (($_GET['flag']) == 'cuscam')
                                             <td class="text-center"><a href="{{URL::to('/CampaignsProductsStep1')}}?id=<?=$B2BCustomer->CustomerId?>&flag=cuscam">Next Step</a></td>
                                             @elseif (($_GET['flag']) == 'custer')
                                             <td class="text-center"><a href="{{URL::to('/Territory1Territory2Step1')}}?id=<?=$B2BCustomer->CustomerId?>">Next Step</a></td>
                                            @elseif (($_GET['flag']) == 'camter')
                                             <td class="text-center"><a href="{{URL::to('/CampaignsProductsStep1')}}?id=<?=$B2BCustomer->CustomerId?>&flag=camter">Next Step</a></td>
                                            @endif
                                            
                                            <td class="text-center">
                                               <input type="checkbox" name="B2BCustomerStatus" id="{{$B2BCustomer->CustomerId}}"  <?=($B2BCustomer->ActiveStatus==1)?"checked":""?> value="{{$B2BCustomer->CustomerId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('B2BCustomer.edit',$B2BCustomer->CustomerId) }}?flag=<?=$_GET['flag']?>"><i class="material-icons">dvr</i></a>
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