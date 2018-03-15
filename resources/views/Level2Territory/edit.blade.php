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
                            {!! Form::model($Level2Territory, ['method' => 'PATCH','class'=>'form-horizontal', 'id'=>'level1_territory','route' => ['Level2Territory.update', $Level2Territory->Level2TerritoryId]]) !!}
                                
                                    <div class="card-header card-header-text">
                                        <h4 class="card-title">Edit Level 2 Territory</h4>
                                    </div>
                                    <div class="card-content">

                                        <!-- <input type="hidden" name="ApplicationOwnerOwnerId" value="1" /> -->

                                         <!-- <input type="hidden" name="B2BCustomerId" value="{{Request::get('id')}}" /> -->

                                        @if (isset($_GET['terid']))
                                          <input type="hidden" name="Level1TerritoryId" value="{{Request::get('terid')}}" />
                                        @elseif (isset($_GET['camterid']))
                                           <input type="hidden" name="CampaignLevel1TerritoryId" value="{{Request::get('camterid')}}" />
                                        @endif
                                         

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Level 2 Territory Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="Level2TerritoryName" required="true" value="{{$Level2Territory->Level2TerritoryName}}" />
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
                                                         @if ($Level2Territory->ActiveStatus == 1)
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