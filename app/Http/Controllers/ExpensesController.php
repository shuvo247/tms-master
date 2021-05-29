<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\ExpenseCategory;
use App\Http\Requests\ExpenseStoreRequest;
use App\Models\Expense;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allExpenseCategory = ExpenseCategory::orderByDesc('id')->get();
        $allExpenses = Expense::orderByDesc('id')->get();
        return view('admin.pages.accounts.expenses.list',compact('allExpenseCategory','allExpenses'));
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
    public function store(ExpenseStoreRequest $request)
    {
        try {
            $expense = new Expense();
            $expense->expense_date = $request->expense_date;
            $expense->expense_category_id = $request->expense_category_id;
            $expense->payment_method_id = $request->payment_method_id;
            $expense->expense_amount = $request->amount;
            $expense->account_information = $request->account_information;
            $expense->note = $request->note;
            $expense->save();
            Session::flash('alert-success', 'Expense added successfully!!');
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
        try {
            $expense = Expense::findOrFail($request->expense_id);
            $allExpenseCategory = ExpenseCategory::orderByDesc('id')->get();
            $allExpenses = Expense::orderByDesc('id')->get();
            
            return view('admin.pages.accounts.expenses.edit',compact('expense','allExpenseCategory','allExpenses'));
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseStoreRequest $request)
    {
        try {
            $expense = Expense::findOrFail($request->expense_id);
            $expense->expense_date = $request->expense_date;
            $expense->expense_category_id = $request->expense_category_id;
            $expense->payment_method_id = $request->payment_method_id;
            $expense->expense_amount = $request->amount;
            $expense->account_information = $request->account_information;
            $expense->note = $request->note;
            $expense->update();
            Session::flash('alert-success', 'Expense updated successfully!!');
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
            $expense = Expense::findOrFail($request->expense_id);
            $expense->delete();
            Session::flash('alert-danger', 'Expense deleted successfully!!');
            return back();
        } catch (\Throwable $th) {
            Session::flash('alert-danger', 'Something went wrong!!');
            return redirect()->back();
        }
    }
}
