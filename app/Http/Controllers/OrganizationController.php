<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Http\Requests\OrganizationStoreRequest;
use Session;
class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = Organization::all();
        return view('admin.pages.registers.organizations.list',compact('organizations'));
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
    public function store(OrganizationStoreRequest $request)
    {
        try {
            $organization = new Organization();
            $organization->organization_type = $request->organization_type;
            $organization->organization_name = $request->organization_name;
            $organization->owner_name = $request->owner_name;
            $organization->address = $request->address;
            $organization->phone = $request->mobile_number;
            if ($request->hasFile('trade_licence')) {
                $image = $request->file('trade_licence');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/');
                $image->move($destinationPath, $name);
                $organization->image = $name;
            }
            $organization->save();
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
