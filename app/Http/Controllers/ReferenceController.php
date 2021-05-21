<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReferenceStoreRequest;
use Session;
use App\Models\Reference;

class ReferenceController extends Controller
{
    public function index()
    {
        $referencess = Reference::all();
        return view('admin.pages.registers.references.list',compact('referencess'));
    }
    // Store Reference

    public function store(ReferenceStoreRequest $request)
    {
        try {
            $referrer = new Reference();
            $referrer->organization_id = $request->organization_id;
            $referrer->referrer_name = $request->referrer_name;
            $referrer->address = $request->address;
            $referrer->mobile_number = $request->mobile_number;
            $referrer->alternative_mobile_number = $request->alternative_mobile_number;
            // $referrer->nid_number = $request->nid_number;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/');
                $image->move($destinationPath, $name);
                $referrer->image = $name;
            }
            $referrer->save();
            Session::flash('alert-success', 'Supplier added successfully!!');
            return back();
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
        }
    }

    // Show Edit Form 
    public function edit(Request $request)
    {
        $reference = Reference::findOrFail($request->reference_id);
        $referencess = Reference::all();
        return view('admin.pages.registers.references.edit',compact('reference','referencess'));
    }

    // Update Reference

    public function update(Request $request)
    {
        try {
            $referrer = Reference::findOrFail($request->reference_id);
            $referrer->organization_id = $request->organization_id;
            $referrer->referrer_name = $request->referrer_name;
            $referrer->address = $request->address;
            $referrer->mobile_number = $request->mobile_number;
            $referrer->alternative_mobile_number = $request->alternative_mobile_number;
            // $referrer->nid_number = $request->nid_number;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/');
                $image->move($destinationPath, $name);
                $referrer->image = $name;
            }
            $referrer->update();
            Session::flash('alert-success', 'Supplier added successfully!!');
            return back();
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
        }
    }
    // Delete Reference
    public function destroy(Request $request)
    {
        return $request;
    }

}
