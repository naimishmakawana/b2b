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
                         {!! Form::open(array('route' => 'B2BCustomerCampaign.store','method'=>'POST', 'class'=>'form-horizontal', 'id'=>'b2b_customer_campaign')) !!}
                            <div class="card-header card-header-text">
                                <h4 class="card-title">B2B Customer Campaign</h4>
                            </div>
                            <div class="card-content">

                                 <input type="hidden" name="B2BCustomerId" value="{{$B2BCustomer->CustomerId}}" />

                                 <input type="hidden" name="flag" value="{{$flag}}" />

                                <div class="row">
                                    <label class="col-sm-7 label-on-left">Customer Name : {{$B2BCustomer->NameOfOrganization}}</label>
                                     <input type="hidden" name="B2BCustomerId" value="{{$B2BCustomer->CustomerId}}" />
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 label-on-left">Campaign Name</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control" type="text" name="CampaignName" required="true" />
                                        </div>
                                    </div>
                                    <label class="col-sm-2 label-on-right">
                                        <code>required</code>
                                    </label>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 label-on-left">Campaign Objective</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <textarea name="CampaignObjective" class="form-control" required="true"></textarea>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 label-on-right">
                                        <code>required</code>
                                    </label>
                                </div>

                                 <div class="row">
                                    <label class="col-sm-3 label-on-left">Campaign Start Date</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control datepicker" type="text" name="CampaignStartDate" required="true" />
                                        </div>
                                    </div>
                                    <label class="col-sm-2 label-on-right">
                                        <code>required</code>
                                    </label>
                                </div>

                                 <div class="row">
                                    <label class="col-sm-3 label-on-left">Campaign End Date</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control datepicker" type="text" name="CampaignEndDate" required="true" />
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
                                    <label class="col-sm-3 label-on-left">If End date - Where do you want to redirect them to?</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control" type="text" name="EndDateRedirectURL" required="true" />
                                        </div>
                                    </div>
                                    <label class="col-sm-2 label-on-right">
                                        <code>required</code>
                                    </label>
                                </div>

                                <hr />

                                <div class="card-header card-header-text">
                                    <h4 class="card-title">Sequential Taps</h4>
                                </div>

                                <div class="row" style="padding:10px;">
                                 <label class="col-sm-3 label-on-left">Tap 1 &nbsp;</label>
                                 <div class="col-sm-6" style="border: 1px solid gray;border-radius:8px;">
                                    <label class="col-sm-2 label-on-left">Redirect URL</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control tap-field" type="text" name="TapRedirectURL[]" required="true" />
                                        </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="row" style="padding:10px;">
                                 <label class="col-sm-3 label-on-left">Tap 2 &nbsp;</label>
                                 <div class="col-sm-6" style="border: 1px solid gray;border-radius:8px;">
                                    <label class="col-sm-2 label-on-left">Redirect URL</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control tap-field" type="text" name="TapRedirectURL[]" required="true" />
                                        </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="row" style="padding:10px;">
                                 <label class="col-sm-3 label-on-left">Tap 3 &nbsp;</label>
                                 <div class="col-sm-6" style="border: 1px solid gray;border-radius:8px;">
                                    <label class="col-sm-2 label-on-left">Redirect URL</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <input class="form-control tap-field" type="text" name="TapRedirectURL[]" required="true" />
                                        </div>
                                    </div>
                                  </div>
                                </div>

                                <div id="add_more_taps_here">
                                </div>

                                <div class="row">
                                     <div class="col-md-2 col-md-offset-5">
                                         <button id="add_more_taps" class="btn btn-primary" type="button" onclick="OnClickToAddMoreTaps();" disabled="true">Add More Taps</button>
                                     </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 label-on-left">Repeat</label>
                                    <div class="col-sm-7">
                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <div class="checkbox">
                                            <label class="col-md-2">
                                                <input type="checkbox" name="Repeat" value="1" checked=""></input>
                                            </label>
                                            </div>
                                        </div>
                                    </div>
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
                                         <button class="btn btn-primary" type="submit" id="campaign_save" disabled="true">Save</button>
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

