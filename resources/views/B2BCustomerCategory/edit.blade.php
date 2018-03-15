@extends('layouts.b2b')
 
@section('content')
 
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            {!! Form::model($B2BCustomerCategory, ['method' => 'PATCH','class'=>'form-horizontal', 'id'=>'b2b_customer_category','route' => ['B2BCustomerCategory.update', $B2BCustomerCategory->CategoryId]]) !!}
                                
                                    <div class="card-header card-header-text">
                                        <h4 class="card-title">Edit B2B Customer Category</h4>
                                    </div>
                                    <div class="card-content">

                                        <!-- <input type="hidden" name="ApplicationOwnerOwnerId" value="1" /> -->

                                       
                                        @if (isset($_GET['id']))
                                         <input type="hidden" name="Id" value="<?=$_GET['id']?>" />
                                          <div class="row">
                                               <label class="col-sm-7 label-on-left">Customer Name : {{$B2BCustomer->NameOfOrganization}}</label>
                                          </div>
                                        @else
                                            <div class="row">
                                                <label class="col-sm-3 label-on-left">Customer Name</label>
                                                <div class="col-sm-7"  >
                                                    <div class="form-group label-floating">
                                                        <select name="B2BCustomerId" class="form-control" required="true">
                                                             <option value=""></option>
                                                             @foreach ($B2BCustomers as $key => $value)
                                                                 @if ($B2BCustomer->CustomerId == $value->CustomerId)
                                                                    <option value="{{ $value->CustomerId }}" selected="">{{ $value->NameOfOrganization }}</option>
                                                                @else
                                                                     <option value="{{ $value->CustomerId }}">{{ $value->NameOfOrganization }}</option>
                                                                @endif
                                                             @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <label class="col-sm-2 label-on-right">
                                                    <code>required</code>
                                                </label>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Category Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="CategoryName" required="true" value="{{$B2BCustomerCategory->CategoryName}}" />
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Active Status</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <div class="checkbox">
                                                    <label class="col-md-2">
                                                         @if ($B2BCustomerCategory->ActiveStatus == 1)
                                                             <input type="checkbox" name="ActiveStatus" value="1" checked="checked"></input>
                                                        @else
                                                             <input type="checkbox" name="ActiveStatus" value="1"></input>
                                                        @endif
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                             
                                        </div>

                                        <div class="row">
                                             <div class="col-md-2 col-md-offset-5">
                                                 <button class="btn btn-primary">Submit</button>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
    
@endsection