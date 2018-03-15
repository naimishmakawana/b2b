<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\B2BCustomerCategory;
use App\B2BCustomer;

class B2BCustomerCategoryController extends Controller
{
    public function index()
    {
        $B2BCustomerCategories = B2BCustomerCategory::select("B2BCustomer.NameOfOrganization","B2BCustomerCategory.*")
        ->join('B2BCustomer', 'B2BCustomer.CustomerId', '=', 'B2BCustomerCategory.B2BCustomerId')
        ->where('B2BCustomerCategory.IsDelete','0')
        ->latest()
        ->get();

        return view('B2BCustomerCategory.index',compact('B2BCustomerCategories'));
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
            return view('B2BCustomerCategory.create',[
                'B2BCustomer' => B2BCustomer::where('CustomerId',$CustomerId)->first(),
                'B2BCustomers' => B2BCustomer::get()
            ]);
        } 
        else
        {
            return view('B2BCustomerCategory.create',[
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
            'CategoryName' => 'required|unique:B2BCustomerCategory,CategoryName,NULL,CategoryId,IsDelete,0'
           // 'CategoryName' => 'required|unique:B2BCustomerCategory'
            
        ]);
        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;    
        B2BCustomerCategory::create($Request->all());
       

        if(isset($Request['Id']) && $Request['Id'] != ''){

             return redirect()->route('CategoriesProductsStep1.index',['id'=>$Request['B2BCustomerId']])->with('success','B2B customer category created successfully.');
        }
        else {
            return redirect()->route('B2BCustomerCategory.index')->with('success','B2B customer category created successfully.');
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(B2BCustomerCategory $B2BCustomerCategory)
    {
        $B2BCustomerId = $B2BCustomerCategory->B2BCustomerId;
       
        return view('B2BCustomerCategory.edit',compact('B2BCustomerCategory'),[
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
    public function update(Request $Request,B2BCustomerCategory $B2BCustomerCategory)
    {
        request()->validate([
           'CategoryName' => 'required|unique:B2BCustomerCategory,CategoryName,'.$B2BCustomerCategory['CategoryId'].',CategoryId,IsDelete,0'
        ]);
   
        $Request['ActiveStatus'] = isset($Request['ActiveStatus']) ? 1 : 0;   
        
        $B2BCustomerCategory->update($Request->all());

        if(isset($Request['Id']) && $Request['Id'] != ''){

             return redirect()->route('CategoriesProductsStep1.index',['id'=>$B2BCustomerCategory['B2BCustomerId']])->with('success','B2B customer category updated successfully.');
        }
        else {
            return redirect()->route('B2BCustomerCategory.index')->with('success','B2B customer category updated successfully.');
        }  
    }
    
}
