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
                             <a  href="{{ url('B2BCustomerCategory/create') }}?id=<?=$CustomerId?>" class="btn btn-primary btn">Create New Category</a>
                        </div>
                         </div>
                    </div>

                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Category Name</th>
                                            <th>Products</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($B2BCustomerCategories as $B2BCustomerCategory)
                                        <tr id="row_{{$B2BCustomerCategory->CategoryId}}">
                                            <td>{{$B2BCustomerCategory->NameOfOrganization}}</td>
                                            <td>{{$B2BCustomerCategory->CategoryName}}</td>
                                            <td> <a href="{{URL::to('/CategoriesProductsStep2')}}?id=<?=$B2BCustomerCategory->CategoryId?>">Add / Remove</a></td>
                                            <td class="text-center">
                                               <input type="checkbox" name="B2BCategoryStatus" id="{{$B2BCustomerCategory->CategoryId}}"  <?=($B2BCustomerCategory->ActiveStatus==1)?"checked":""?> value="{{$B2BCustomerCategory->CategoryId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('B2BCustomerCategory.edit',$B2BCustomerCategory->CategoryId) }}?id=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteCategory({{$B2BCustomerCategory->CategoryId}})" href="#"><i class="material-icons">close</i></a>
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