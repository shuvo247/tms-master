<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use Session;
class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = ProductAttribute::all();
        return view('admin.pages.products.attributes.list',compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'attribute_name' => 'required|unique:product_attributes',
        ]);
        try {
            $product_attribute = new ProductAttribute();
            $product_attribute->attribute_name = $request->attribute_name;
            $product_attribute->save();
            Session::flash('alert-success', 'Product attribute created successfully!!');
            return back();
           
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
           
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'attribute_name' => 'required',
        ]);
        try {
            $product_attribute = ProductAttribute::findOrFail($request->attribute_id);
            $product_attribute->attribute_name = $request->attribute_name;
            $product_attribute->update();
            Session::flash('alert-success', 'Product attribute updated successfully!!');
            return back();
           
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $product_attribute = ProductAttribute::findOrFail($request->attribute_id);
            $product_attribute->delete();
            Session::flash('alert-success', 'Product attribute updated successfully!!');
            return back();
           
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
           
        }
    }
}
