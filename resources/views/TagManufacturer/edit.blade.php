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
                            {!! Form::model($TagManufacturer, ['method' => 'PATCH','class'=>'form-horizontal', 'id'=>'tag_manufacturer','route' => ['TagManufacturer.update', $TagManufacturer->TagManufacturerId]]) !!}
                                
                                    <div class="card-header card-header-text">
                                        <h4 class="card-title">Edit Tag Manufacturer</h4>
                                    </div>
                                    <div class="card-content">

                                        <!-- <input type="hidden" name="ApplicationOwnerOwnerId" value="1" /> -->

                                        <input type="hidden" name="B2BCustomerId" value="{{Request::get('id')}}" />

                                        <div class="row">
                                               <label class="col-sm-7 label-on-left">Application Owner : {{$ApplicationOwner->NameOfOrganization}}</label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Manufacturer Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="ManufacturerName" required="true" value="{{$TagManufacturer->ManufacturerName}}" />
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Address Line 1</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="AddressFirstLine" value="{{$TagManufacturer->AddressFirstLine}}"/>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Address Line 2</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="AddressSecondLine" value="{{$TagManufacturer->AddressSecondLine}}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">City</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="City" value="{{$TagManufacturer->City}}"/>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">State</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="State" value="{{$TagManufacturer->State}}"/>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Country</label>
                                            <div class="col-sm-7"  >
                                                <div class="form-group label-floating">
                                                    <select name="CountryId" class="form-control">
                                                         @foreach ($Countries as $key => $value)
                                                            @if ($value->id == $TagManufacturer->CountryId)
                                                                 <option selected="selected" value="{{ $value->id }}">{{ $value->CountryName }}</option>
                                                            @else
                                                                 <option value="{{ $value->id }}">{{ $value->CountryName }}</option>
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
                                            <label class="col-sm-3 label-on-left">Zip/Postal Code</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="PostalCode" value="{{$TagManufacturer->PostalCode}}" maxlength="10"/>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Contact Person First Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="ContactPersonFirstName" value="{{$TagManufacturer->ContactPersonFirstName}}"/>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Contact Person Last Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="ContactPersonLastName" value="{{$TagManufacturer->ContactPersonLastName}}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Contact E-mail Address</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="ContactPersonEmailAddress" value="{{$TagManufacturer->ContactPersonEmailAddress}}" />
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Contact Person Designation</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="ContactPersonDesignation" value="{{$TagManufacturer->ContactPersonDesignation}}" />
                                                </div>
                                            </div>
                                            <label class="col-sm-2 label-on-right">
                                                <code>required</code>
                                            </label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Contact Person Telnumber</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="ContactPersonTelNumber" value="{{$TagManufacturer->ContactPersonTelNumber}}"/>
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
                                                         @if ($TagManufacturer->ActiveStatus == 1)
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