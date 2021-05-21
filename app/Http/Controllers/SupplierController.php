<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SupplierStoreRequest;
use App\Models\Supplier;
use Session;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.pages.registers.suppliers.list',compact('suppliers'));
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
    public function store(SupplierStoreRequest $request)
    {
        try {
            $supplier = new Supplier();
            $supplier->organization_id = $request->organization_id;
            $supplier->supplier_name = $request->supplier_name;
            $supplier->address = $request->address;
            $supplier->mobile_number = $request->mobile_number;
            $supplier->alternative_mobile_number = $request->alternative_mobile_number;
            $supplier->nid_number = $request->nid_number;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/');
                $image->move($destinationPath, $name);
                $supplier->image = $name;
            }
            $supplier->save();
            Session::flash('alert-success', 'Supplier added successfully!!');
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
    public function show(Request $request)
    {
        $supplier = Supplier::findOrFail($request->supplier_id);
        return view('admin.pages.registers.suppliers.show',compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $supplier = Supplier::findOrFail($request->supplier_id);
        $suppliers = Supplier::all();
        return view('admin.pages.registers.suppliers.edit',compact('supplier','suppliers'));
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
            $supplier = Supplier::findOrFail($request->supplier_id);
            $supplier->organization_id = $request->organization_id;
            $supplier->supplier_name = $request->supplier_name;
            $supplier->address = $request->address;
            $supplier->mobile_number = $request->mobile_number;
            $supplier->alternative_mobile_number = $request->alternative_mobile_number;
            $supplier->nid_number = $request->nid_number;
            if ($request->hasFile('image')) {
                if(isset($supplier->image)){
                    unlink('/uploads/'.$supplier->image);
                }
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/');
                $image->move($destinationPath, $name);
                $supplier->image = $name;
            }
            $supplier->update();
            Session::flash('alert-success', 'Supplier updated successfully!!');
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
            $supplier = Supplier::findOrFail($request->supplier_id);
            $supplier->delete();
            Session::flash('alert-danger', 'Supplier deleted successfully!!');
            return redirect()->route('register.supplier.list');
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
        }
    }
}
