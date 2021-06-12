<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\VariableProductStock;
use App\Models\ProductStock;
use App\Models\Purchase;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoicePayment;
use Session;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseInvoice = PurchaseInvoice::orderByDesc('id')->get();
        return view('admin.pages.purchases.list',compact('purchaseInvoice'));
    }
    // Return view for show stock Details
    public function productDetails(Request $request)
    {
        $productId = $request->product_id;
        $idValue = $request->id_value;
        $productIdArray = explode("_",$productId);
        if($productIdArray[0] == 'single'){
            $ProductStockInfo = ProductStock::where('product_id',$productIdArray[1])->first();
        }else{
            $ProductStockInfo = VariableProductStock::findOrFail($productIdArray[1]);
        }
        return view('admin.pages.purchases.stock',compact('ProductStockInfo','idValue'));
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
        // return $request;
        try {
            $purchase_invoice = new PurchaseInvoice();
            $purchase_invoice->supplier_id = $request->supplier_id;
            $purchase_invoice->note = $request->purchase_note;
            $purchase_invoice->purchase_date = $request->purchase_date;
            $purchase_invoice->sub_total = $request->sub_total;
            $purchase_invoice->vat_in = $request->vat_type;
            $purchase_invoice->vat = $request->purchase_vat_amount;
            $purchase_invoice->discount_in = $request->total_discount_type;
            $purchase_invoice->discount = $request->purchase_total_discount;
            $purchase_invoice->discount_note = $request->discount_note;
            $purchase_invoice->total_payable = $request->total_amount;
            $purchase_invoice->cash_given = $request->cash_given;
            if (isset($request->change_amount)) {
                $purchase_invoice->change = $request->change_amount;
            }else{
                $purchase_invoice->due = $request->total_amount-$request->cash_given;
            }
            $purchase_invoice->due = $request->cash_given;
            $purchase_invoice->save();
            $count = count($request->product_id);
            for ($i=0; $i < $count; $i++) { 
                $purchase = new Purchase();
                // Retrive Product ID
                $productId = $request->product_id[$i];
                $productIdArray = explode("_",$productId);
                if($productIdArray[0] == 'single'){
                    $ProductStockInfo = ProductStock::where('product_id',$productIdArray[1])->first();
                    $purchase->product_type = 0;
                }else{
                    $ProductStockInfo = VariableProductStock::findOrFail($productIdArray[1]);
                    $purchase->product_type = 1;
                    $purchase->product_size_id = $ProductStockInfo->size_attribute_id ?? '1';
                    $purchase->product_grade_id = $ProductStockInfo->grade_attribute_id ?? '1';
                }
                // End Retrive Product ID
                $purchase->product_id = $productIdArray[1];
                $purchase->purchase_invoice_id = $purchase_invoice->id;
                $purchase->purchase_box = $request->purchase_box[$i];
                $purchase->purchase_pcs = $request->purchase_pcs[$i];
                $purchase->purchase_qty_in_sft = $request->purchase_quantity[$i];
                $purchase->purchase_rate = $request->purchase_price[$i];
                $purchase->discount_type = 1;
                $purchase->discount = $request->discount[$i];
                $purchase->total = $request->total[$i];
                $purchase->save();

            }
            $count = count($request->purchase_paid);
            for ($i=0; $i < $count; $i++) { 
                $purchase_invoice_payment = new PurchaseInvoicePayment();
                $purchase_invoice_payment->purchase_invoice_id = $purchase_invoice->id;
                $purchase_invoice_payment->paid = $request->purchase_paid[$i];
                $purchase_invoice_payment->payment_method = $request->payment_method[$i];
                $purchase_invoice_payment->account_info = $request->account_info[$i];
                $purchase_invoice_payment->note = $request->payment_note[$i];
                $purchase_invoice_payment->save();
        }
        Session::flash('alert-success', 'Product updated successfully!!');
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
        $purchase_invoice = PurchaseInvoice::findOrFail($request->purchase_invoice_id);
        $products  = Product::orderByDesc('id')->get();
        return view('admin.pages.purchases.edit',compact('purchase_invoice','products'));
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
