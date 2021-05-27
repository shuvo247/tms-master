<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Session;
class ExpenseCategoryController extends Controller
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
            'expense_category_name' => 'required|unique:expense_categories'
        ]);

        try {
            $expense_category = new ExpenseCategory();
            $expense_category->expense_category_name = $request->expense_category_name;
            $expense_category->status = 1;
            $expense_category->save();
            Session::flash('alert-success', 'Expense category added successfully!!');
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
            'expense_category_name' => 'required|unique:expense_categories'
        ]);
        try {
            $expense_category = ExpenseCategory::findOrFail($request->expense_category_id);
            $expense_category->expense_category_name = $request->expense_category_name;
            $expense_category->update();
            Session::flash('alert-success', 'Expense category updated successfully!!');
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
            $expense_category = ExpenseCategory::findOrFail($request->expense_category_id);
            $expense_category->delete();
            Session::flash('alert-danger', 'Expense category deleted successfully!!');
            return back();
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
        }
    }
}
