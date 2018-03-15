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
                                <b>Campaign Name : {{$CampaignName}}</b>
                         </div>
                    </div>

                    <div class="card-content">
                    <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>B2B Customer Name</th>
                                            <th>Product Name</th>
                                            <th class="disabled-sorting text-center">Campaigns</th> 
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                            <th class="disabled-sorting text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($B2BCustomerProducts as $B2BCustomerProduct)
                                        <tr id="row_{{$B2BCustomerProduct->ProductId}}">
                                            <td>{{$B2BCustomerProduct->NameOfOrganization}}</td>
                                            <td>{{$B2BCustomerProduct->ProductName}}</td>
                                             <td class="text-center"><a href="#" data-toggle="modal" data-target=".example-modal-lg" onclick="ViewCampaignsByProduct({{$B2BCustomerProduct->ProductId}})">View</a></td>
                                            <td class="text-center">
                                               <input type="checkbox" name="B2BProductStatus" id="{{$B2BCustomerProduct->ProductId}}"  <?=($B2BCustomerProduct->ActiveStatus==1)?"checked":""?> value="{{$B2BCustomerProduct->ProductId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('B2BCustomerProduct.edit',$B2BCustomerProduct->ProductId) }}?camid=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteProduct({{$B2BCustomerProduct->ProductId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                             <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon" onclick="OnRemoveProductFromCampaign({{$B2BCustomerProduct->CampaignProductId}})" href="#"><i class="material-icons dp48">remove_circle</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>

                            <br />
                           
                            <div class="col-md-12" style="text-align: center;"> 
                                 <a  href="{{ url('B2BCustomerProduct/create') }}?id=<?=$B2BCustomerId?>&camid=<?=$CampaignId?>" class="btn btn-primary btn">Create New Product</a>
                            </div>

                            <div class="row" style="text-align: center;"> 
                                 <div class="col-md-12">
                                        <b>Available Products</b>
                                 </div>
                            </div>


                            <div class="card-content">
                            <div class="material-datatables">
                                <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                           <!--  <th>B2B Customer Name</th> -->
                                            <th class="disabled-sorting text-center">Associated Campaigns</th>
                                            <th>Product Name</th>
                                            <th class="disabled-sorting text-center">Active</th>
                                            <th class="disabled-sorting text-center">Edit</th>
                                            <th class="disabled-sorting text-center">Deactive</th>
                                            <th class="disabled-sorting text-center">Add</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($AvailableB2BCustomerProducts as $AvailableB2BCustomerProduct)
                                        <tr id="row_{{$AvailableB2BCustomerProduct->ProductId}}"> 
                                             <td class="text-center"><a href="#" data-toggle="modal" data-target=".example-modal-lg" onclick="ViewCampaignsByProduct({{$AvailableB2BCustomerProduct->ProductId}})">View</a></td>
                                            <td>{{$AvailableB2BCustomerProduct->ProductName}}</td>
                                            <td class="text-center">
                                               <input type="checkbox" name="B2BProductStatus" id="{{$AvailableB2BCustomerProduct->ProductId}}"  <?=($AvailableB2BCustomerProduct->ActiveStatus==1)?"checked":""?> value="{{$AvailableB2BCustomerProduct->ProductId}}">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-warning btn-icon edit" href="{{ route('B2BCustomerProduct.edit',$AvailableB2BCustomerProduct->ProductId) }}?camid=<?=$_GET['id']?>"><i class="material-icons">dvr</i></a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-simple btn-danger btn-icon remove" onclick="OnDeleteProduct({{$AvailableB2BCustomerProduct->ProductId}})" href="#"><i class="material-icons">close</i></a>
                                            </td>
                                              <td class="text-center">
                                                <a class="btn btn-simple btn-success btn-icon remove" onclick="OnAddProductInCampaign({{$AvailableB2BCustomerProduct->ProductId}},{{$CampaignId}})" href="#"><i class="material-icons dp48">add_circle</i></a>
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

    <div class="modal fade example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="CatProductsModal">
                
            </div>
        </div>
    </div>                   

      
@endsection