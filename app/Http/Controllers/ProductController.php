<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductStock;
use Auth;
use App\Models\VariableProductStock;
use App\Http\Requests\ProductStoreRequest;
use Session;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productAttribute = ProductAttribute::all();
        $attributeValue = AttributeValue::all();
        return view('admin.pages.products.products.list',compact('productAttribute','attributeValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productAttribute = ProductAttribute::all();
        $attributeValue = AttributeValue::all();
        return view('admin.pages.products.products.add',compact('productAttribute','attributeValue'));
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
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id    = $request->brand_id;
        $product->purchase_from = $request->supplier_id;
        $product->payment_method_id = $request->payment_method_id;
        $product->added_by = Auth::user()->id ?? '1';
        $product->product_name = $request->product_name;
        $product->pcs_per_box = $request->pcs_per_box;
        $product->alert_qty = $request->alert_quantity;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/');
            $image->move($destinationPath, $name);
            $product->image = $name;
        }
        if($request->product_type == 'single'){
            $product->product_variant = '0';
            $product->save();
            $product_stock = new ProductStock();
            $product_stock->product_id = $product->id;
            $product_stock->purchase_price = $request->purchase_price;
            $product_stock->selling_price = $request->sell_price;
            $product_stock->qty_in_sft = $request->qty_in_sft;
            $product_stock->save();
        }
        if($request->product_type == 'variable'){
            $product->product_variant = '1';
            $product->save();
            $count = count($request->size_attribute_id);
            for ($i=0; $i < $count; $i++) { 
                $variable_product_stock = new VariableProductStock();
                $variable_product_stock->product_id = $product->id;
                $variable_product_stock->size_attribute_id = $request->size_attribute_id[$i];
                $variable_product_stock->grade_attribute_id = $request->grade_attribute_id[$i];
                $variable_product_stock->purchase_price = $request->variant_purchase_price[$i];
                $variable_product_stock->selling_price = $request->variant_sell_price[$i];
                $variable_product_stock->qty_in_sft = $request->quantity[$i];
                $variable_product_stock->save();
              }
        }
        return back()->with('message','Product added successfully');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
