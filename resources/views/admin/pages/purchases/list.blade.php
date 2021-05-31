@extends('admin.master')
@section('custom_styles')
<link href="{{asset('backend/assets/css/select-2.css')}}" rel="stylesheet" />
<style>
    .select2-container{
        width: 100% !important;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
     @include('admin.partials.flash')
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Purchase List </h4>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table" id="purchaseTable">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Date</th>
                                <!-- <th scope="col">Invoice No.</th> -->
                                <th scope="col">Supplier</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Paid</th>
                                <th scope="col">Due</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($purchaseInvoice as $invoice)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$invoice->purchase_date ?? ''}}</td>
                                    <td>{{$invoice->supplier->supplier_name ?? ''}}</td>
                                    <td>{{$invoice->total_payable ?? ''}}</td>
                                    <td>{{$invoice->cash_given ?? ''}}</td>
                                    <td>{{$invoice->due ?? ''}}</td>
                                    <td>
                                        <a href="{{route('purchase.edit',['purchase_invoice_id' => $invoice->id])}}">
                                            <i class="font-18 far fa-edit text-info"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-danger text-center" colspan="7">This table data is empty</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script src="{{asset('backend/assets/js/select-2.js')}}"></script>
<script>
    // Select 2 and DataTable
    $('#purchaseTable').DataTable();
    $('.select-2').select2();
</script>
@endsection