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
                                 {!! Form::open(array('route' => 'B2BCustomerProduct.store','method'=>'POST', 'class'=>'form-horizontal', 'id'=>'b2bcustomer_product', 'enctype'=>'multipart/form-data')) !!}
                                    <div class="card-header card-header-text">
                                        <h4 class="card-title">B2B Customer Product</h4>
                                    </div>
                                    <div class="card-content">

                                        
                                        @if (isset($_GET['catid']))
                                           <input type="hidden" name="CategoryId" value="<?=$_GET['catid']?>" />
                                           <input type="hidden" name="B2BCustomerId" value="{{$B2BCustomer->CustomerId}}" />
                                            <div class="row">
                                                <label class="col-sm-7 label-on-left">Customer Name : {{$B2BCustomer->NameOfOrganization}}</label>
                                            </div>
                                        @elseif (isset($_GET['camid']))
                                            <input type="hidden" name="CampaignId" value="<?=$_GET['camid']?>" />
                                            <input type="hidden" name="B2BCustomerId" value="{{$B2BCustomer->CustomerId}}" />
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
                                                             @foreach ($B2BCustomers as $key => $B2BCustomer)
                                                                <option value="{{ $B2BCustomer->CustomerId }}">{{ $B2BCustomer->NameOfOrganization }}</option>
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
                                            <label class="col-sm-3 label-on-left">Product Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="ProductName" required="true" />
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                         <div class="row">
                                            <label class="col-sm-3 label-on-left">Product Image</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail">
                                                        <img src="../../assets/img/image_placeholder.jpg" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-round btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="ProductImg" />
                                                        </span>
                                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                    </div>
                                                </div>
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
                                                        <input type="checkbox" name="ActiveStatus" value="1" checked=""></input>
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

