<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Session;
class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = PaymentMethod::orderByDesc('id')->get();
        return view('admin.pages.products.payment-method.list',compact('payment_methods'));
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
            'method_name' => 'required|unique:payment_methods',
            'description' => 'nullable'
        ]);
        try {
            $payment_method = new PaymentMethod();
            $payment_method->method_name = $request->method_name;
            $payment_method->description = $request->description;
            $payment_method->save();
            Session::flash('alert-success', 'Payment method created successfully!!');
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
            'method_name' => 'required',
            'description' => 'nullable'
        ]);
        try {
            $payment_method = PaymentMethod::findOrFail($request->payment_method_id);
            $payment_method->method_name = $request->method_name;
            $payment_method->description = $request->description;
            $payment_method->update();
            Session::flash('alert-success', 'Payment method updated successfully!!');
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
            $payment_method = PaymentMethod::findOrFail($request->payment_method_id);
            $payment_method->delete();
            Session::flash('alert-danger', 'Payment method deleted successfully!!');
            return back();
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
        }
        
    }
}
