@extends('layouts.b2b')
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
           
                    <div class="row"> 
                         <div class="col-md-12">
                         <div class="col-md-10 card-header card-header-text">
                            <h4 class="card-title">Solution Feature</h4>
                           
                        </div>
                         <div class="col-md-2">
                             <a style="float: right;" href="{{ url('SolutionFeature/create') }}" class="btn btn-primary btn-sm">Create Solution Feature</a>
                        </div>
                         </div>
                    </div>

                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SolutionFeatureName</th>
                                            <th class="disabled-sorting text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SolutionFeatureName</th>
                                            <th class="disabled-sorting text-center">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach ($SolutionFeature as $value)
                                        <tr>
                                            <td>{{$value->SolutionFeatureName}}</td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('SolutionFeature.edit',$value->SolutionFeatureId) }}"><i class="material-icons">dvr</i></a>
                                            </td>
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

    {!! $SolutionFeature->render() !!}


      
@endsection