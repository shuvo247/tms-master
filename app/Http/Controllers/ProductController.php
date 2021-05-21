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
        $products  = Product::all();
        return view('admin.pages.products.products.list',compact('products'));
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
        return view('admin.pages.products.products.add-product',compact('productAttribute','attributeValue'));
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
            // Variation Product Update
            Session::flash('alert-success', 'Product updated successfully!!');
            return redirect()->route('product.product.list');
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
        $product = Product::findOrFail($request->product_id);
        return view('admin.pages.products.products.edit',compact('product'));
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
            $product = Product::findOrFail($request->product_id);
            $product->category_id = $request->category_id;
            $product->brand_id    = $request->brand_id;
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
            // Single Product Update 
            if($product->product_variant == 0){
                $product->update();
                $product_stock = ProductStock::where('product_id',$product->id)->first();
                $product_stock->purchase_price = $request->purchase_price;
                $product_stock->selling_price = $request->sell_price;
                $product_stock->qty_in_sft = $request->qty_in_sft;
                $product_stock->update();
            }
            // End Single Product Update
            // Variation Product Update
            if($product->product_variant == 1){
                $product->update();
                // Delete Product Variation
                $value = array_map('intval',$request->variable_product_id);
                if (isset($value)) {
                    $delete_attribute = VariableProductStock::whereNotIn('id',$value)
                                        ->where('product_id',$product->id)
                                        ->delete();
                }
                // End Delete Product Variation
                // Update Product Variation Info
                $count = count($request->variable_product_id);
                for ($i=0; $i < $count; $i++) { 
                    $variable_product_stock = VariableProductStock::findOrFail($request->variable_product_id[$i]);
                    $variable_product_stock->size_attribute_id = $request->size_attribute_id[$i];
                    $variable_product_stock->grade_attribute_id = $request->grade_attribute_id[$i];
                    $variable_product_stock->purchase_price = $request->variant_purchase_price[$i];
                    $variable_product_stock->selling_price = $request->variant_sell_price[$i];
                    $variable_product_stock->qty_in_sft = $request->quantity[$i];
                    $variable_product_stock->update();
                  }
                // End Update Product Variation Info
                // Upload New Product Variation
                if (isset($request->new_size_attribute_id)) {
                    $count = count($request->new_size_attribute_id);
                        for ($i=0; $i < $count; $i++) { 
                            $variable_product_stock = new VariableProductStock();
                            $variable_product_stock->product_id = $product->id;
                            $variable_product_stock->size_attribute_id = $request->new_size_attribute_id[$i];
                            $variable_product_stock->grade_attribute_id = $request->new_grade_attribute_id[$i];
                            $variable_product_stock->purchase_price = $request->new_variant_purchase_price[$i];
                            $variable_product_stock->selling_price = $request->new_variant_sell_price[$i];
                            $variable_product_stock->qty_in_sft = $request->new_quantity[$i];
                            $variable_product_stock->save();
                        }
                  }
                // End Upload New Product Variation
            }
            // Variation Product Update
            Session::flash('alert-success', 'Product updated successfully!!');
            return redirect()->route('product.product.list');
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
            // Find Product For Delete Product
            $product = Product::findOrFail($request->product_id);
            // Find Product Variation
            if ($product->product_variant == 0) {
                $delete_product_stock = ProductStock::where('product_id',$request->product_id)->delete();
            }else{
                $delete_variable_product_stock = VariableProductStock::where('product_id',$request->product_id)->delete();
            }
            $product->delete();

            Session::flash('alert-danger', 'Product deleted successfully!!');
            return back();
            
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
        }
    }
}
