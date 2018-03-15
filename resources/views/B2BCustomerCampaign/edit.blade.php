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
                            {!! Form::model($B2BCustomerCampaign, ['method' => 'PATCH','class'=>'form-horizontal', 'id'=>'b2b_customer_campaign','route' => ['B2BCustomerCampaign.update', $B2BCustomerCampaign->CampaignId]]) !!}
                                
                                    <div class="card-header card-header-text">
                                        <h4 class="card-title">Edit B2B Customer Campaign</h4>
                                    </div>
                                    <div class="card-content">

                                        <!-- <input type="hidden" name="ApplicationOwnerOwnerId" value="1" /> -->

                                        <input type="hidden" name="flag" value="<?=$_GET['flag'];?>" />

                                        <div class="row">
                                               <label class="col-sm-7 label-on-left">Customer Name : {{$B2BCustomer->NameOfOrganization}}</label>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Campaign Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="CampaignName" required="true" value="{{$B2BCustomerCampaign->CampaignName}}" />
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
                                                    <textarea name="CampaignObjective" class="form-control" required="true">{{$B2BCustomerCampaign->CampaignObjective}}</textarea>
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
                                                    <input class="form-control datepicker" type="text" name="CampaignStartDate" required="true" value="<?=date("m/d/Y",strtotime($B2BCustomerCampaign->CampaignStartDate));?>"/>
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
                                                    <input class="form-control datepicker" type="text" name="CampaignEndDate" required="true" value="<?=date("m/d/Y",strtotime($B2BCustomerCampaign->CampaignEndDate));?>"/>
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
                                            <input class="form-control" type="text" name="RedirectURL" value="{{$B2BCustomerCampaign->RedirectURL}}" required="true" />
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
                                                <input class="form-control" type="text" name="EndDateRedirectURL" required="true" value="{{$B2BCustomerCampaign->EndDateRedirectURL}}"/>
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

                                    
                                    @foreach ($CampaignSequentialTaps as $key => $CampaignSequentialTap)

                                        <div class="row" style="padding:10px;">
                                         <label class="col-sm-3 label-on-left">Tap {{$key + 1}} &nbsp;</label>
                                         <div class="col-sm-6" style="border: 1px solid gray;border-radius:8px;">
                                            <label class="col-sm-2 label-on-left">Redirect URL</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control tap-field" type="text" name="TapRedirectURL[]" required="true" value="{{$CampaignSequentialTap->RedirectURL}}" />
                                                    <input type="hidden" name="CampaignSequentialTapId[]" value="{{$CampaignSequentialTap->CampaignSequentialTapId}}">
                                                </div>
                                            </div>
                                          </div>
                                        </div>

                                     @endforeach

                                    <div id="add_more_taps_here">
                                    </div>

                                    <div class="row">
                                         <div class="col-md-2 col-md-offset-5">
                                             <button id="add_more_taps" class="btn btn-primary" type="button" onclick="OnClickToAddMoreTaps();">Add More Taps</button>
                                         </div>
                                    </div> 

                                    <div class="row">
                                        <label class="col-sm-3 label-on-left">Repeat</label>
                                        <div class="col-sm-7">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <div class="checkbox">
                                                <label class="col-md-2">
                                                    @if ($B2BCustomerCampaign->Repeat == 1)
                                                         <input type="checkbox" name="Repeat" value="1" checked="checked"></input>
                                                    @else
                                                         <input type="checkbox" name="Repeat" value="1"></input>
                                                    @endif
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
                                                        @if ($B2BCustomerCampaign->ActiveStatus == 1)
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
                                                 <button class="btn btn-primary" id="campaign_save" type="submit">Submit</button>
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