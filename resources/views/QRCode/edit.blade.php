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
                            {!! Form::model($QRCode, ['method' => 'PATCH','class'=>'form-horizontal', 'id'=>'b2bcustomer_product', 'enctype'=>'multipart/form-data','route' => ['QRCode.update', $QRCode->QRCodeId]]) !!}
                                
                                    <div class="card-header card-header-text">
                                        <h4 class="card-title">Edit QR Code</h4>
                                    </div>
                                    <div class="card-content">

                                    @if (isset($_GET['CampaignId']))
                                           <input type="hidden" name="CampaignId" value="<?=$_GET['CampaignId']?>" />
                                    @elseif (isset($_GET['CampaignLevel1TerritoryId']))
                                           <input type="hidden" name="CampaignLevel1TerritoryId" value="<?=$_GET['CampaignLevel1TerritoryId']?>" />
                                    @elseif (isset($_GET['CampaignLevel2TerritoryId']))
                                           <input type="hidden" name="CampaignLevel2TerritoryId" value="<?=$_GET['CampaignLevel2TerritoryId']?>" />
                                    @endif

                                    <div class="row">
                                        <label class="col-sm-3 label-on-left">Customer Name</label>
                                        <div class="col-sm-7"  >
                                            <div class="form-group label-floating">
                                                <select name="B2BCustomerId" class="form-control" required="true">
                                                     <option value=""></option>
                                                     @foreach ($B2BCustomers as $key => $value)
                                                        @if ($QRCode->B2BCustomerId == $value->CustomerId)
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

                                        
                                      <div class="row">
                                            <label class="col-sm-3 label-on-left">QR Code File Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="QRCodeFileName" required="true" value="{{$QRCode->QRCodeFileName}}" />
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
                                                    @if ($QRCode->QRCodeImageURL != '')
                                                       <img src="/qrcodeimages/{{$QRCode->QRCodeImageURL}}" alt="...">
                                                       <input type="hidden" name="OldQRCodeImage" value="{{$QRCode->QRCodeImageURL}}" />
                                                    @else
                                                        <img src="../../assets/img/image_placeholder.jpg" alt="...">
                                                    @endif
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-round btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="QRCodeImage" />
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
                                                    <input class="form-control" type="text" name="QRCodeGeneratorName" required="true" value="{{$QRCode->QRCodeGeneratorName}}" />
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
                                                    <input class="form-control" type="text" name="RedirectURL" required="true" value="{{$QRCode->RedirectURL}}" />
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
                                                         @if ($QRCode->ActiveStatus == 1)
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