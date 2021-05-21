<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\SupplierType;
class SupplierTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier_types = SupplierType::orderByDesc('id')->get();
        return view('admin.pages.registers.suppliers.supplier-type.list',compact('supplier_types'));
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
            'supplier_type' => 'required|unique:supplier_types',
            'description' => 'nullable'
        ]);
        try {
            $payment_method = new SupplierType();
            $payment_method->supplier_type = $request->supplier_type;
            $payment_method->description = $request->description;
            $payment_method->save();
            Session::flash('alert-success', 'Supplier type created successfully!!');
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
        try {
            $payment_method = SupplierType::findOrFail($request->supplier_type_id);
            $payment_method->supplier_type = $request->supplier_type;
            $payment_method->description = $request->description;
            $payment_method->update();
            Session::flash('alert-success', 'Supplier type updated successfully!!');
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
            $supplier_type = SupplierType::findOrFail($request->supplier_type_id);
            $supplier_type->delete();
            Session::flash('alert-danger', 'Supplier type deleted successfully!!');
            return redirect()->route('register.supplier.supplier-type.list');
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
        }
    }
}
