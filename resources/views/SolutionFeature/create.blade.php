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
                                 {!! Form::open(array('route' => 'SolutionFeature.store','method'=>'POST', 'class'=>'form-horizontal', 'id'=>'solution_feature')) !!}
                                    <div class="card-header card-header-text">
                                        <h4 class="card-title">Solution Feature</h4>
                                    </div>
                                    <div class="card-content">

                                     <input type="hidden" name="B2BCustomerId" value="{{Request::get('id')}}" />

                                        <div class="row">
                                            <label class="col-sm-3 label-on-left">Solution Feature Name</label>
                                            <div class="col-sm-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"></label>
                                                    <input class="form-control" type="text" name="SolutionFeatureName" required="true" />
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

