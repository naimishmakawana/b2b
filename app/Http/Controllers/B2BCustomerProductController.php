<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomerProduct;
use App\B2BCustomer;
use App\B2BCustomerCategory;
use Illuminate\Support\Facades\Input;
use Image;
use Illuminate\Routing\UrlGenerator;


class B2BCustomerProductController extends Controller
{
    public function index()
    {
        $B2BCustomerProducts = B2BCustomerProduct::select("B2BCustomer.NameOfOrganization","B2BCustomerProduct.*")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerProduct.B2BCustomerId')
        ->where('B2BCustomerProduct.IsDelete','0')
        ->latest()
        ->get();

        return view('B2BCustomerProduct.index',compact('B2BCustomerProducts'));
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        if(isset($_GET['id']) && $_GET['id'] != '')
        {
            $CustomerId = $_GET['id'];
            return view('B2BCustomerProduct.create',[
                'B2BCustomer' => B2BCustomer::where('CustomerId',$CustomerId)->first(),
                'B2BCustomers' => B2BCustomer::get()
            ]);
        } 
        else
        {
            return view('B2BCustomerProduct.create',[
                'B2BCustomers' => B2BCustomer::where('IsDelete','0')->get()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $Request)
    { 
        request()->validate([
            'ProductName' => 'required|unique:B2BCustomerProduct,ProductName,NULL,ProductId,IsDelete,0'
            //'ProductName' => 'required|unique:B2BCustomerProduct'  
        ]);

        if(Input::hasFile('ProductImg'))
        {

                request()->validate([
                    'ProductImg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:6048',
                ]);

                $imageName = rand().time().'.'.request()->ProductImg->getClientOriginalExtension(); 

                // Save thumbnail image
                $img = Image::make(request()->ProductImg->getRealPath());

                $img->resize(100, 100, function ($constraint) {

                    $constraint->aspectRatio();

                })->save(public_path('/images/thumb/').$imageName);

                // Save original size image
                request()->ProductImg->move(public_path('images'), $imageName);


                $Request['ProductImage'] = $imageName; 
        }


        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;  

        B2BCustomerProduct::create($Request->all());

        if(isset($Request['CategoryId'])){

            return redirect()->route('CategoriesProductsStep2.index',['id'=>$Request['CategoryId']])->with('success','B2B customer product created successfully.');

        } else if(isset($Request['CampaignId'])){

            return redirect()->route('CampaignsProductsStep2.index',['id'=>$Request['CampaignId']])->with('success','B2B customer product created successfully.');
        } else {
            return redirect()->route('B2BCustomerProduct.index')->with('success','B2B customer product created successfully.');
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(B2BCustomerProduct $B2BCustomerProduct)
    {
        
        $B2BCustomerId = $B2BCustomerProduct->B2BCustomerId;
       
        return view('B2BCustomerProduct.edit',compact('B2BCustomerProduct'),[
            'B2BCustomer' => B2BCustomer::where('CustomerId',$B2BCustomerId)->first(),
            'B2BCustomers' => B2BCustomer::where('IsDelete','0')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $Request,B2BCustomerProduct $B2BCustomerProduct)
    {
        request()->validate([
            'ProductName' => 'required|unique:B2BCustomerProduct,ProductName,'.$B2BCustomerProduct['ProductId'].',ProductId,IsDelete,0'
            
        ]);

        if(Input::hasFile('ProductImg'))
        {

                request()->validate([
                    'ProductImg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:6048',
                ]);

                $imageName = rand().time().'.'.request()->ProductImg->getClientOriginalExtension(); 

                // Save thumbnail image
                $img = Image::make(request()->ProductImg->getRealPath());

                $img->resize(100, 100, function ($constraint) {

                    $constraint->aspectRatio();

                })->save(public_path('/images/thumb/').$imageName);

                // Save original size image
                request()->ProductImg->move(public_path('images'), $imageName);

                $Request['ProductImage'] = $imageName; 

                if(isset($Request['OldProductImg']) && $Request['OldProductImg'] != '')
                {
                    unlink(public_path('/images/').$Request['OldProductImg']);
                    unlink(public_path('/images/thumb/').$Request['OldProductImg']);
                }
        }
   
        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        $B2BCustomerProduct->update($Request->all());

        if(isset($Request['CategoryId'])){

            return redirect()->route('CategoriesProductsStep2.index',['id'=>$Request['CategoryId']])->with('success','B2B customer product updated successfully.');

        } else if(isset($Request['CampaignId'])){

            return redirect()->route('CampaignsProductsStep2.index',['id'=>$Request['CampaignId']])->with('success','B2B customer product updated successfully.');
        }else {
            return redirect()->route('B2BCustomerProduct.index')->with('success','B2B customer product updated successfully.');
        }  
       
    }
    
}
