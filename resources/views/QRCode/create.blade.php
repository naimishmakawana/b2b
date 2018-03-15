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
                                 {!! Form::open(array('route' => 'QRCode.store','method'=>'POST', 'class'=>'form-horizontal', 'id'=>'qr_code', 'enctype'=>'multipart/form-data')) !!}
                                    <div class="card-header card-header-text">
                                        <h4 class="card-title">QR Code</h4>
                                    </div>
                                    <div class="card-content">

                                    @if (isset($_GET['B2BCustomerId']))
                                           <input type="hidden" name="B2BCustomerIdFromTer" value="<?=$_GET['B2BCustomerId']?>" />
                                    @elseif (isset($_GET['CampaignId']))
                                           <input type="hidden" name="CampaignId" value="<?=$_GET['CampaignId']?>" />
                                    @elseif (isset($_GET['CampaignLevel1TerritoryId']))
                                           <input type="hidden" name="CampaignLevel1TerritoryId" value="<?=$_GET['CampaignLevel1TerritoryId']?>" />
                                    @endif

                                    <div class="row">
                                        <label class="col-sm-3 label-on-left">Customer Name</label>
                                        <div class="col-sm-7">
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

                                     <div class="row">
                                            <label class="col-sm-3 label-on-left">QR Code File Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="QRCodeFileName" required="true" />
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div> 

                                         <div class="row">
                                            <label class="col-sm-3 label-on-left">QR Code Image URL</label>
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
                                                        <input type="file" name="QRCodeImage" required="" />
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
                                            <label class="col-sm-3 label-on-left">QR Code Generator Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="QRCodeGeneratorName" required="true" />
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Redirect URL</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="RedirectURL" required="true" />
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

