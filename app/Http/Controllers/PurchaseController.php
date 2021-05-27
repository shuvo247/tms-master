<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\VariableProductStock;
use App\Models\ProductStock;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    // Return view for show stock Details
    public function productDetails(Request $request)
    {
        $productId = $request->product_id;
        $productIdArray = explode("_",$productId);
        if($productIdArray[0] == 'single'){
            $ProductStockInfo = ProductStock::where('product_id',$productIdArray[1])->first();
        }else{
            $ProductStockInfo = VariableProductStock::findOrFail($productIdArray[1]);
        }
        return view('admin.pages.purchases.stock',compact('ProductStockInfo'));
    }

    // Purchase Product Info

    public function productInfo(Request $request)
    {
        $productId = $request->product_id;
        $productIdArray = explode("_",$productId);
        if($productIdArray[0] == 'single'){
            $ProductStockInfo = ProductStock::where('product_id',$productIdArray[1])->first();
        }else{
            $ProductStockInfo = VariableProductStock::findOrFail($productIdArray[1]);
        }
        return $ProductStockInfo;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products  = Product::orderByDesc('id')->get();
        return view('admin.pages.purchases.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
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
