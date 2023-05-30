<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(request()->ajax()){
            
            // dd("in");
            $products=Product::all();
            // dd($roles);
    
            return datatables()->of($products)->addColumn('action',function($data){

                if(auth()->user()->can('product-edit')){
                    $display_edit='';
                    }else{
                        $display_edit='d-none';
                    }

             if(auth()->user()->can('product-delete')){
                        $display_delete='';
                        }else{
                            $display_delete='d-none';
                        }
    
    
    
            return '<div class="actions">
                   <a class="text-black '.$display_edit.'" href="'.route('products.edit',$data->id).'">
                       <i class="feather-edit-3 me-1"></i> Edit
                   </a>
                   <a class="text-danger '.$display_delete.'" href="'.route('products.destroy',$data->id).'">
                       <i class="feather-trash-2 me-1"></i> Delete
                   </a>
                   
                  
               </div>';
            })->make(true);
        }
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $products = new Product();
        $products->name = $request->name;
        $products->detail = $request->detail;
        $products->save();

        return redirect()->route('products.index')->with('Success','Product Added Successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products=Product::Find($id);
        return view('products.edit',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd("in");
        $products=Product::Find($id);
        $products->name = $request->name;
        $products->detail = $request->detail;
        $products->save();

        return redirect()->route('products.index')->with('Success','Product Updated Successfully.');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
