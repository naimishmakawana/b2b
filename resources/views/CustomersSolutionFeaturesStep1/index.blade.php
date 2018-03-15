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
           
                    <br />
                    
                    <div class="row" style="text-align: center;"> 
                         <div class="col-md-12">
                                <b>B2B Customer Name : {{$NameOfOrganization}}</b>
                         </div>
                    </div>

                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>B2B Customer Name</th>
                                            <th>Solution Feature Name</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($CustomerSolutionFeatures as $CustomerSolutionFeature)
                                        <tr id="row_{{$CustomerSolutionFeature->SolutionFeatureId}}">
                                            <td>{{$CustomerSolutionFeature->NameOfOrganization}}</td>
                                            <td>{{$CustomerSolutionFeature->SolutionFeatureName}}</td>
                                            <td class="text-center">
                                               <input type="checkbox" name="SolutionFeatureStatus" id="{{$CustomerSolutionFeature->SolutionFeatureId}}"  <?=($CustomerSolutionFeature->ActiveStatus==1)?"checked":""?> value="{{$CustomerSolutionFeature->SolutionFeatureId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('SolutionFeature.edit',$CustomerSolutionFeature->SolutionFeatureId) }}?id=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>
                                             <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon" onclick="OnRemoveSolutionFeatureFromCustomer({{$CustomerSolutionFeature->CustomerSolutionFeatureId}})" href="#"><i class="material-icons dp48">remove_circle</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>

                            <br />
                           
                            <div class="col-md-12" style="text-align: center;"> 
                                 <a  href="{{ url('SolutionFeature/create') }}?id=<?=$B2BCustomerId?>" class="btn btn-primary btn">Create New Solution Features</a>
                            </div>

                            <div class="row" style="text-align: center;"> 
                                 <div class="col-md-12">
                                        <b>Available Solution Features </b>
                                 </div>
                            </div>


                            <div class="card-content">
                            <div class="material-datatables">
                                <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Solution Feature Name</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                            <th class="disabled-sorting text-center">Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($AvailableCustomerSolutionFeatures as $AvailableCustomerSolutionFeature)
                                        <tr id="row_{{$AvailableCustomerSolutionFeature->SolutionFeatureId}}"> 
                                            <td>{{$AvailableCustomerSolutionFeature->SolutionFeatureName}}</td>
                                            <td class="text-center">
                                               <input type="checkbox" name="SolutionFeatureStatus" id="{{$AvailableCustomerSolutionFeature->SolutionFeatureId}}"  <?=($AvailableCustomerSolutionFeature->ActiveStatus==1)?"checked":""?> value="{{$AvailableCustomerSolutionFeature->SolutionFeatureId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('SolutionFeature.edit',$AvailableCustomerSolutionFeature->SolutionFeatureId) }}?id=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteSolutionFeature({{$AvailableCustomerSolutionFeature->SolutionFeatureId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                              <td class="text-center">
                                                <a class="btn btn-simple btn-success btn-icon remove" onclick="OnAddSolutionFeatureInCustomer({{$AvailableCustomerSolutionFeature->SolutionFeatureId}},{{$B2BCustomerId}})" href="#"><i class="material-icons dp48">add_circle</i></a>
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


      
@endsection