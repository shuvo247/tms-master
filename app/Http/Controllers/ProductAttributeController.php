<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use Session;
use App\Models\AttributeValue;
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
            'attribute_name' => 'unique:product_attributes',
        ]);
        try {
            $product_attribute = new ProductAttribute();
            $product_attribute->attribute_name = $request->attribute_name;
            $product_attribute->save();
            $count = count($request->attribute_value);
            for ($i=0; $i < $count; $i++) { 
             {{--   <?php
                    $string = '8.455X12.34Inch';
                    preg_match_all('/\d+(\.\d+)?/', $string, $matches);
                    print_r($matches); 
                    ?> --}} 

                $attribute_value = new AttributeValue();
                $attribute_value->attribute_id = $product_attribute->id;
                $attribute_value->attribute_value = $request->attribute_value[$i];
                $attribute_value->save();
              }
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
    public function edit(Request $request)
    {
        $attribute = ProductAttribute::findOrFail($request->attribute_id);
        $attributes = ProductAttribute::all();
        return view('admin.pages.products.attributes.edit',compact('attribute','attributes'));
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
        try {
            // Try to Update Product Attribute Name
            // $product_attribute = ProductAttribute::findOrFail($request->attribute_id);
            // $product_attribute->attribute_name = $request->attribute_name;
            // $product_attribute->update();
            // Try to update Attribute Value
            if (isset($request->new_attribute_value)) {
                $attributeCount = count($request->new_attribute_value);
                for ($i=0; $i < $attributeCount; $i++) { 
                    $attribute_value = AttributeValue::findOrFail($request->attribute_value_id[$i]);
                    $attribute_value->attribute_value = $request->attribute_value[$i];
                    $attribute_value->update();
                  }
            }
            // Delete Attribute
            $value = array_map('intval',$request->attribute_value_id);
            if (isset($value)) {
                $delete_attribute = AttributeValue::whereNotIn('id',$value)
                                    ->where('attribute_id',$request->attribute_id)
                                    ->delete();
            }
              // Try to Upload New Attribute
              if (isset($request->new_attribute_value)) {
                $newAttributeCount = count($request->new_attribute_value);
                    for ($i=0; $i < $newAttributeCount; $i++) { 
                        $attribute_value = new AttributeValue();
                        $attribute_value->attribute_id = $request->attribute_id;
                        $attribute_value->attribute_value = $request->new_attribute_value[$i];
                        $attribute_value->save();
                    }
              }
            //   Try to Delete Attribute
           
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
            // Delete Attribute Value
            $product_attribute_value = AttributeValue::where('attribute_id',$product_attribute->id)->delete();
            // Delete Product Attribute
            $product_attribute->delete();
            Session::flash('alert-success', 'Product attribute updated successfully!!');
            return back();
           
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
           
        }
    }
}
