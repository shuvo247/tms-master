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

        try {
            $product_attribute = new ProductAttribute();
            $product_attribute->attribute_name = $request->attribute_name;
            $product_attribute->save();
            $count = count($request->attribute_value);
            for ($i=0; $i < $count; $i++) { 
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
            $product_attribute = ProductAttribute::findOrFail($request->attribute_id);
            $product_attribute->attribute_name = $request->attribute_name;
            $product_attribute->update();
            // Try to update Attribute Value
            $attributeCount = count($request->attribute_value);
            for ($i=0; $i < $attributeCount; $i++) { 
                $attribute_value = AttributeValue::findOrFail($request->attribute_value_id[$i]);
                $attribute_value->attribute_value = $request->attribute_value[$i];
                $attribute_value->update();
              }
              // Try to Upload New Attribute
              $newAttributeCount = count($request->new_attribute_value);
              if (isset($newAttributeCount)) {
                    for ($i=0; $i < $newAttributeCount; $i++) { 
                        $attribute_value = new AttributeValue();
                        $attribute_value->attribute_id = $request->attribute_id;
                        $attribute_value->attribute_value = $request->new_attribute_value[$i];
                        $attribute_value->save();
                    }
              }
            //   // Try to Delete Attribute
            //   $deleteAttributeValue = AttributeValue::findOrFail('id','!==',$request->attribute_value_id);
            //   $deleteAttributeValue->delete();
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
