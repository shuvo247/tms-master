@extends('admin.master')
@section('custom_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="row">
    <div class="col-12">
    @include('admin.partials.flash')
    </div>
    {{-- Add Organization  --}}
    <div class="col-4">
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Categories </h4>
                </div>
                <div class="col-7 align-self-center mb-2">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#expenseCategoryAddModal" data-whatever="@mdo">Add Category</button>
                    </div>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allExpenseCategory as $expense_category)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$expense_category->expense_category_name ?? ''}}</td>
                                    <td>
                                        <a href="/" data-toggle="modal" data-target="#expenseCategoryEditModal" onclick="riseExpenseCategoryEditModal('{{$expense_category->expense_category_name}}','{{$expense_category->id}}')"><i class="font-18 far fa-edit text-info"></i></a>
                                        <a href="{{route('account.expenses.category.destroy',['expense_category_id' => $expense_category->id])}}"><i class="font-18 far fa-trash-alt text-danger"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-danger text-center" colspan="3">This table data is empty</td>
                                </tr>
                            @endforelse 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Expenses</h4>
                <div class="repeater-default m-t-30">
                    <div data-repeater-list="">
                        <div data-repeater-item="">
                            <form action="{{ route('account.expenses.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="expenseDate">Select Date <span class="text-danger">*</span></label>
                                        <input id="expenseDate" name="expense_date" class="form-control" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" required="">
                                    </div>
                                    <div class="form-group col-md-4">                                        
                                    <label for="expenseCategoryName">Select Category <span class="text-danger">*</span></label>
                                        <select class="form-control select-2" id="expenseCategoryName" name="expense_category_id">
                                            @foreach (App\Models\ExpenseCategory::orderByDesc('id')->get() as $expense_category)
                                                <option value="{{$expense_category->id}}">{{$expense_category->expense_category_name}}</option>
                                            @endforeach
                                          </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="owner_name">Amount <span class="text-danger">*</span></label>
                                        <input name="amount" type="text" class="form-control" id="amount" placeholder="Ex : 10000000">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                    <label for="paymentMethod">Payment Method </label>
                                        <select class="form-control select-2" id="paymentMethod" name="payment_method_id">
                                            @foreach (App\Models\PaymentMethod::orderByDesc('id')->get() as $payment_method)
                                                <option value="{{$payment_method->id}}">{{$payment_method->method_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="accountInfo">Account Info </label>
                                        <textarea name="account_information" class="form-control" id="accountInfo" rows="1" placeholder="Account Information...."></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="image">Note</label>
                                        <textarea name="note" class="form-control" id="note" rows="1" placeholder="Note...."></textarea>
                                    </div>
                                </div>
                            <hr>
                        </div>
                    </div>
                    <button data-repeater-create="" class="btn btn-info waves-effect waves-light">Save Changes
                    </button>
                    <a href="{{route('account.expenses.list')}}" class="btn btn-secondary" data-dismiss="modal">Close</a>
                </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Add Supplier --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">All Organization </h4>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table" id="expensesTable">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Organization Type</th>
                                <th scope="col">Organization</th>
                                <th scope="col">Owner Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.pages.accounts.expenses.categories.modals.add-category')
@include('admin.pages.accounts.expenses.categories.modals.edit-category')
@endsection
@section('custom_scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('backend')}}/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
        function riseExpenseCategoryEditModal(expense_category_name,id){
            $('#hiddenExpenseCategoryId').val(id);
            $('#expenseCategoryEditModal input[name="expense_category_name"]').val(expense_category_name);
        }
    $(document).ready(function() {
        $('.select-2').select2();
        $('#expensesTable').DataTable();
        jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker('setDate', 'now');
        // rise Expense Category Edit MOdal

        // End Rise Expense Category Edit Modal

});
</script>
@endsection