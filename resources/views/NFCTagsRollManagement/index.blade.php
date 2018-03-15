@extends('layouts.b2b')
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('fail'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    <style type="text/css">
            table.scroll {
                width: 100%;  /* Optional */
                border-collapse: collapse; 
                border-spacing: 0;
                border: 2px solid gray;
            }
            table.scroll tbody,
            table.scroll thead { display: block; }
            thead tr th { 
                height: 30px;
                line-height: 30px;
                border-right: 1px solid gray; 
                background:gainsboro;
                /* text-align: left; */
            }
            table.scroll tbody {
                max-height: 300px;
                overflow-y: auto;
                overflow-x: hidden;
            }
            tbody { border-top: 2px solid gray; }
            tbody td, thead th {
                
                 border-right: 1px solid gray;
                 /*white-space: nowrap; */
            }
            tbody td:last-child, thead th:last-child {
                border-right: none;
            }
            .form-group
            {
                padding-bottom:0 !important;
            }
            .form-control
            {
                border: 1px solid gray !important;;
                padding : 5px !important;;
            }
    </style>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
             <div class="card">

               {!! Form::open(array('route' => 'NFCTagsRollManagement.store','method'=>'POST', 'class'=>'form-horizontal', 'id'=>'tag_roll_form')) !!}
                
                <div class="card-content">
                    <div class="row"> 
                         <div class="col-md-12">
                             <div class="col-md-10 card-header card-header-text">
                                <h4 class="card-title">Select Roll</h4>
                            </div>
                        </div>
                    </div>

                    <div class="material-datatables">
                        <table class="table table-striped table-no-bordered table-hover dataTable no-footer scroll" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th style="width: 200PX;" class="text-center">Roll #</th>
                                    <th style="width: 320PX;" class="text-center">Manufacturer</th>
                                    <th style="width: 200PX;" class="text-center">Start #</th>
                                    <th style="width: 200PX;" class="text-center">End #</th>
                                    <th style="width: 200PX;" class="text-center">Assigned</th>
                                    <th style="width: 200PX;" class="text-center">Available</th>
                                    <th style="width: 190PX;" class="text-center"> Select </th>
                                </tr>
                            </thead>
                            <tbody >
                            @foreach ($TagRolls as $TagRoll)
                                <tr>
                                    <td style="width: 200PX;" class="text-center">{{$TagRoll->OriginatingRollId}}</td>
                                    <td style="width: 320PX;" class="text-center">{{$TagRoll->ManufacturerName}}</td>
                                    <td style="width: 200PX;" class="text-center">{{$TagRoll->StartSequence}} 
                                        <input type="hidden" id="sq_start_{{$TagRoll->NFCTagId}}" value="{{$TagRoll->StartSequence}}"></td>
                                    <td style="width: 200PX;" class="text-center">{{$TagRoll->EndSequence}}
                                        <input type="hidden" id="sq_end_{{$TagRoll->NFCTagId}}" name="sq_end_{{$TagRoll->NFCTagId}}" value="{{$TagRoll->EndSequence}}" ></td>
                                    <td style="width: 200PX;" class="text-center">{{($TagRoll->tot - $TagRoll->Available)}}</td>
                                    <td style="width: 200PX;" class="text-center">{{$TagRoll->Available}}</td>
                                    <td style="width: 190PX;" class="text-center"><input type="radio" name="NFCTagId" value="{{$TagRoll->NFCTagId}}" onclick="OnSelectNFCTag({{$TagRoll->NFCTagId}});"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="row" style="padding:20px;"> 
                        <div class="col-md-12" style="border:2px solid gray;border-radius:15px;padding-bottom:9px;">

                             <div class="col-md-6">

                                    <input type="hidden" id="NFCTagId" name="NFCTagId"/>
                                    <input type="hidden" id="TagBundleId" name="TagBundleId"/>

                                    <div class="row">
                                        <label class="col-sm-5 label-on-left">Manufacturer Name</label>
                                        <div class="col-sm-5">
                                            <div class="form-group label-floating" >
                                                <label class="control-label"></label>
                                                <input class="form-control" type="text" id="ManufacturerName" name="ManufacturerName" required="true" readonly="true"/>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <label class="col-sm-5 label-on-left">Roll #</label>
                                        <div class="col-sm-5">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <input class="form-control" type="text" id="RollNo" name="RollNo" required="true"  readonly="true" />
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <label class="col-sm-5 label-on-left">Number of Tags</label>
                                        <div class="col-sm-5">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <input class="form-control" type="text" name="NumberOfTags" id="NumberOfTags" required="true" onchange="OnChangeNumberOfTags(this.value)" maxlength="10" />
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <label class="col-sm-5 label-on-left">Starting Sequence No.</label>
                                        <div class="col-sm-5">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <input class="form-control" type="text" name="StartingSequenceNo" required="true" readonly="true" id="StartingSequenceNo" />
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <label class="col-sm-5 label-on-left">Ending Sequence No.</label>
                                        <div class="col-sm-5">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <input class="form-control" type="text" name="EndingSequenceNo" required="true" readonly="true" id="EndingSequenceNo" />
                                            </div>
                                        </div>
                                    </div> 
                             </div>

                             <div class="col-md-6">

                                    <div class="card-header card-header-text" style="padding-left:150px">
                                        <h4 class="card-title">Select Customer</h4>
                                    </div>

                                    <div class="material-datatables" style="padding-left:150px">
                                        <table class="table table-striped table-no-bordered table-hover dataTable no-footer scroll" cellspacing="0" width="80%" style="width:80%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width:500px;">Customer Name</th>
                                                    <th class="text-center" style="width:500px;">Select</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($B2BCustomers as $B2BCustomer)
                                                <tr style="border: 1px solid gray">
                                                    <td class="text-center" style="width:500px;">{{$B2BCustomer->NameOfOrganization}}</td>
                                                    <td class="text-center" style="width:500px;"><input type="radio" name="B2BCustomerId" value="{{$B2BCustomer->CustomerId}}"></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                             </div>

                        </div>
                    </div>

                     <div class="row">
                         <div class="col-md-2 col-md-offset-5">
                             <button class="btn btn-primary" type="submit">Assign Tags</button>
                         </div>
                    </div>

                </div>
            </form>
            </div>
        </div>
    </div>

   

    <div class="row">
        <div class="col-md-12">
             <div class="card">

              <div class="card-content">
                    <div class="row"> 
                         <div class="col-md-12">
                             <div class="col-md-10 card-header card-header-text">
                                <h4 class="card-title">History of Assigments for Selected Roll</h4>
                            </div>
                        </div>
                    </div>

                    <div class="material-datatables">
                        <table class="table table-striped table-no-bordered table-hover dataTable no-footer" cellspacing="0" width="100%" style="width:100%;border: 1px solid gray;">
                            <thead>
                                <tr>
                                    <th style="border: 1px solid gray;" class="text-center">Roll #</th>
                                    <th style="border: 1px solid gray;" class="text-center">Manufacturer Name</th>
                                    <th style="border: 1px solid gray;" class="text-center">Customer Name</th>
                                    <th style="border: 1px solid gray;" class="text-center">Number of Tags</th>
                                    <th style="border: 1px solid gray;" class="text-center">Bundle Number</th>
                                    <th style="border: 1px solid gray;" class="text-center">Campaign</th>
                                    <th style="border: 1px solid gray;"class="text-center">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($TagRollsHistory as $value)
                                <tr>
                                    <td class="text-center">{{$value->OriginatingRollId}}</td>
                                    <td class="text-center">{{$value->ManufacturerName}}</td>
                                    <td class="text-center">{{$value->NameOfOrganization}}</td>
                                    <td class="text-center">{{$value->NumberofTags}}</td>
                                    <td class="text-center">{{$value->TagBundleId}}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"><a href="#">Edit</a></td>
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