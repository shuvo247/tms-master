@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.partials.flash')
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">All Payment Method </h4>
                </div>
                <div class="col-7 align-self-center mb-2">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentPethodAddModal" data-whatever="@mdo">Add Payment Method</button>
                    </div>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table" id="paymentMethodTable">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Method Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payment_methods as $payment_method)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$payment_method->method_name}}</td>
                                <td>{{$payment_method->description}}</td>
                                <td>
                                    <a href="/" data-toggle="modal" data-target="#paymentMethodEditModal" onclick="risePaymentMethodEditModal('{{$payment_method->method_name}}','{{$payment_method->description}}','{{$payment_method->id}}')"><i class="font-18 far fa-edit text-info"></i></a>
                                    <a href="{{route('product.payment-method.destroy',['payment_method_id' => $payment_method->id])}}"><i class="font-18 far fa-trash-alt text-danger"></i></a>
                                </td>
                            </tr>
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
</div>
@include('admin.pages.products.payment-method.modals.add-payment-method')
@include('admin.pages.products.payment-method.modals.edit-payment-method')
@endsection
@section('custom_styles')
@endsection
@section('custom_scripts')
<script>
    $('#paymentMethodTable').DataTable();
    function risePaymentMethodEditModal(method_name,description,id){
      $('#hiddenPaymentMethodId').val(id);
       $('#paymentMethodEditModal input[name="method_name"]').val(method_name);
       $('#paymentMethodEditModal textarea[name="description"]').val(description);
    }
 </script>
@endsection