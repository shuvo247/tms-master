@extends('admin.master')
@section('custom_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css"/ >
<link rel="stylesheet" type="text/css" href="{{asset('backend')}}/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<style>
   #purchaseProduct .select2-container .select2-selection--single {
      height: 34px;
    }
    #purchaseProduct .select2-container .select2-selection--single .select2-selection__rendered {
    padding-top: 3px;
    }
    #purchaseProduct input{
        border-radius:4px;
    }
    #getMultipleRow .select2-results__option {
        padding: 6px;
        user-select: none;
        font-size: 12px !important;
        -webkit-user-select: none;
    }
    #purchaseProduct .select2-container--default{
        width:100%;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{route('purchase.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div style=";padding-top: 10px" class="row">
                        <div class="col-md-4">
                            <div style="margin-bottom: 5px" class="form-group row">
                                <label for="productname" class="col-md-4 col-form-label">Supplier *</label>
                                <div class="col-md-8">
                                    <select class="select-2">
                                        @foreach(App\Models\Supplier::all() as $supplier)
                                            <option value="2" data-select2-id="4">{{ $supplier->organization->organization_name}} | {{$supplier->supplier_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="margin-bottom: 5px" class="form-group row">
                                <label style="text-align: right" for="productname" class="col-md-4 col-form-label">Note </label>
                                <div class="col-md-8">
                                    <input id="purchase_note" name="purchase_note" type="text" placeholder="Purchase note" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div style="margin-bottom: 5px" class="form-group row">
                                <label style="text-align: right" for="productname" class="col-md-4 col-form-label">Date * </label>
                                <div class="col-md-8">
                                    <input id="purchase_date" name="purchase_date" type="text" class="form-control" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 5px" class="row" id="purchaseProduct">
                        <div style="background-color: #D2D2D2;height: 280px;padding-top: 5px;overflow-y: auto;overflow-x: auto" class="col-md-12 input_fields_wrap getMultipleRow">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="mb-2 col-md-3 text-dark">
                                    <label for="attributeName" class="col-form-label">Product</label>
                                        <div id="inputFormRow">
                                            <select class="form-control select-2"  name="product_id[]" id="selectedProduct">
                                                <option> -- Select Product -- </option>
                                                @foreach ($products as $product)
                                                    @foreach($product->variable_product_stock as $stock)
                                                        <option value="variable_{{$stock->id}}">{{$product->product_name}} | {{$stock->size_attribute->attribute_value}} | {{$stock->grade_attribute->attribute_value}} | {{$product->category->category_name}} | {{$product->brand->brand_name}} </option>
                                                    @endforeach
                                                @endforeach
                                                @foreach(App\Models\Product::where('product_variant',0)->get() as $product)
                                                    <option  value="single_{{$product->id}}">{{$product->product_name}} | {{$product->category->category_name}} | {{$product->brand->brand_name}} </option>
                                                @endforeach
                                            </select>
                                            <div id="Stock">
                                                @include('admin.pages.purchases.stock')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="attributeName" class="col-form-label">Box</label>
                                            <div id="inputFormRow">
                                            <div class="input-group mb-3">
                                                <input type="text" name="purchase_box[]" class="form-control m-input" placeholder="Box" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Pcs</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="purchase_pcs[]" class="form-control m-input" placeholder="Pcs" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Qty(sft)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="purchase_quantity[]" class="form-control m-input" placeholder="Quantity" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Price</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="purchase_price[]" id="purchasePrice" class="form-control m-input" placeholder="Price" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Dis. Type</label>
                                            <div class="input-group mb-3">
                                                <select name="" id="" class="form-control">
                                                    <option value="percent">%</option>
                                                    <option value="bdt">BDT</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Discount</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="discount[]" class="form-control m-input" placeholder="Discount" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Total</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="total[]" class="form-control m-input" placeholder="Total" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="attributeName" class="col-form-label">Add Row</label>
                                        <div class="ml-auto">
                                            <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="newRow" class="row">
                                    
                                </div>
                            </div>
                        </div>                         
                    </div>
                </div> 
                <div class="row  py-3" style="background-color: #F4F4F7;" id="purchaseProduct">
                    <div class="col-md-6" style="background-color: #D2D2D2;height: 280px;padding-top: 5px;overflow-y: auto;overflow-x: auto">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                    <label for="attributeName" class="col-form-label">Paid</label>
                                        <div id="inputFormRow">
                                            <input type="number" name="purchase_paid[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="attributeName" class="col-form-label">Method</label>
                                            <div id="inputFormRow">
                                            <select class="form-control select-2" name="payment_method[]">
                                                @foreach(App\Models\PaymentMethod::all() as $method)
                                                    <option value="">{{$method->method_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Account</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="account_info[]" class="form-control m-input" placeholder="Account Info" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Note</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="payment_note[]" class="form-control m-input" placeholder="Note" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="attributeName" class="col-form-label">Add Row</label>
                                        <div class="ml-auto">
                                            <button id="addPaymentRow" type="button" class="btn btn-info">Add Row</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="newPaymentRow" class="row">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="col-md-12">
                        <div style="margin-bottom: 5px" class="form-group row" >
                                <label style="text-align: right" class="col-md-5 col-form-label">Sub Total</label>
                                <div class="col-md-7">
                                    <input type="text" id="subTotalBdt" name="sub_total" class="form-control">
                                </div>
                            </div>
                            <div style="margin-bottom: 5px" class="form-group row">
                                <label style="text-align: right" class="col-md-5 col-form-label">VAT</label>
                                <div style="padding-right: 0px" class="col-md-3">
                                    <select style="border-radius: 4px;cursor: pointer" class="form-control" id="vat_type_0" name="vat_type" oninput="calculateActualAmount(0)">
                                        <option style="padding: 10px" value="0" selected="">%</option>
                                        <option style="padding: 10px" value="1">BDT</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input id="purchase_vat_amount" type="text" class="form-control width-xs" name="purchase_vat_amount" value="" oninput="calculateActualAmount(0)">
                                </div>
                            </div><div style="margin-bottom: 5px" class="form-group row">
                                <label style="text-align: right" class="col-md-5 col-form-label">Discount</label>
                                <div style="padding-right: 0px" class="col-md-3">
                                    <select style="border-radius: 4px;cursor: pointer" class="form-control totalDiscountType" id="total_discount_type_0" name="total_discount_type" oninput="calculateActualAmount(0)">
                                        <option style="padding: 10px" value="1" selected="">BDT</option>
                                        <option style="padding: 10px" value="0">%</option>
                                    </select>
                                </div>

                                <div style="padding-left: 0px" class="col-md-4">
                                    <input id="purchase_total_discount" type="text" class="form-control totalDiscount" name="purchase_total_discount" value="0" oninput="calculateActualAmount(0)">
                                </div>
                            </div>
                            <div style="margin-bottom: 5px" class="form-group row">
                                <label style="text-align: right" class="col-md-5 col-form-label">Dis. Note</label>
                                <div class="col-md-7">
                                    <input id="discount_note" type="text" class="form-control width-xs" name="discount_note" value="" placeholder="Discount Note">
                                </div>
                            </div>
                            <!-- <div style="margin-bottom: 5px" class="form-group row">
                                <label style="text-align: right" class="col-md-5 col-form-label">Coupon</label>
                                <div class="col-md-7">
                                    <input id="coupon_code" type="number" class="form-control width-xs couponCode" name="coupon_code" onchange="couponMembership()" placeholder="Coupon/Membership">
                                </div>
                            </div> -->
                            <!-- Invoice Column One -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="margin-bottom: 5px" class="form-group row">
                            <label style="text-align: right" class="col-md-5 col-form-label">Total Payable</label>
                            <div class="col-md-7">
                                <input type="text" id="totalBdt" class="form-control">
                                <input style="display: none" type="text" id="totalBdtShow" name="total_amount" readonly="">
                            </div>
                        </div>
                        <div style="margin-bottom: 5px" class="form-group row">
                            <label style="text-align: right" class="col-md-5 col-form-label">Cash Given</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="cash_given" name="cash_given" placeholder="Cash Given">
                            </div>
                        </div>
                        <div style="margin-bottom: 5px" class="form-group row">
                            <label style="text-align: right" class="col-md-5 col-form-label">Change</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="change_amount" name="change_amount" placeholder="Change Amount" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 mt-3 f-left">
                        <button class="btn btn-success waves-effect waves-light" type="submit">Submit
                        </button>
                        <button class="btn btn-success waves-effect waves-light" type="submit">Submit and Print
                        </button>
                        <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light m-l-10" type="button">Reset
                        </button>
                    </div>
                </div> 
            </div>
        </form>
    </div>
</div>
@endsection
@section('custom_scripts')            
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('backend')}}/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    $('#selectedProduct').change(function(){
       var productId = $(this).val();
       $.get("{{route('purchase.product_details')}}",{
           product_id : productId
           },function(data){
            $('#Stock').empty().html(data);
        });
        $.get("{{route('purchase.product_info')}}",{
           product_id : productId
           },function(data){
            $('#purchasePrice').val(data.purchase_price);
        });
    });
    $(document).ready(function() {
        function addCounter() {     //this function set the counter variable value static.
        var cust_count = 0;
            return function() {
                cust_count++;
                return cust_count;   //return the incremented value on click
            };
        }
        var countVar = addCounter();
    
        $("#addRow").click(function () { 
            var j = countVar(); 
            var html = '';
            html += '<div class="recentRow col-12 row" style="margin:0;padding:0">';
            html += ' <div class="form-group col-md-3">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<select class="form-control select-2 selectOption" id="selectNewRowProduct'+j+'" name="product_id[]">';
            html += '@foreach ($products as $product)';
            html += '@foreach($product->variable_product_stock as $stock)';
            html += '<option value="variable_{{ $stock->id }}">{{$product->product_name}} | {{$stock->size_attribute->attribute_value}} | {{$stock->grade_attribute->attribute_value}} | {{$product->category->category_name}} | {{$product->brand->brand_name}} </option>';
            html += '@endforeach';
            html += '@endforeach';
            html += '@foreach(App\Models\Product::where('product_variant',0)->get() as $product)';
            html += '<option value="single_{{$product->id}}">{{$product->product_name}} | {{$product->category->category_name}} | {{$product->brand->brand_name}} </option>';
            html += '@endforeach';
            html += '</select>';
            html += '<div id="Stock'+j+'">';
            html += '@include('admin.pages.purchases.stock')';
            html += '</div>'
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text" name="purchase_box[]" class="form-control m-input" placeholder="Box" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text" name="purchase_pcs[]" class="form-control m-input" placeholder="Pcs" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text" name="purchase_quantity[]" class="form-control m-input" placeholder="Quantity" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text" name="purchase_price[]" id="purchasePrice'+j+'" class="form-control m-input" placeholder="Price" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<select name="" id="" class="form-control">';
            html += '<option value="percent">%</option>';
            html += '<option value="bdt">BDT</option>';
            html += '</select>'
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text" name="discount[]" class="form-control m-input" placeholder="Discount" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-2">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text" name="total[]" class="form-control m-input" placeholder="Total" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
       $('#newRow').append(html);

    $("#selectNewRowProduct"+j).change(function(){
       var productId = $(this).val();
       $.get("{{route('purchase.product_details')}}",{
           product_id : productId
           },function(data){
            $('#Stock'+j).empty().html(data);
        });
        $.get("{{route('purchase.product_info')}}",{
           product_id : productId
           },function(data){
            $('#purchasePrice'+j).val(data.purchase_price);
        });
    });
       $('.select-2').select2();
   });


   // remove row
   $(document).on('click', '#removeRow', function () {
       $(this).closest('.recentRow').remove();
   });

   // Payment Method Multiple Row
    $("#addPaymentRow").click(function () {
        var html = '';
        html += '<div class="recentRow col-12 row" style="margin:0;padding:0">';
        html += ' <div class="form-group col-md-3">';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group">';
        html += '<input name="purchase_paid" type="text" class="form-control">';
        html += '<div class="input-group-append">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += ' <div class="form-group col-md-2">';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group">';
        html += '<select class="form-control select-2" name="payment_method[]">';
        html += '@foreach (App\Models\PaymentMethod::all() as $method)';
        html += '<option value="{{$method->id}}">{{$method->method_name}}</option>';
        html += '@endforeach';
        html += '</select>'
        html += '<div class="input-group-append">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += ' <div class="form-group col-md-3">';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group">';
        html += '<input type="text" name="account_info[]" class="form-control m-input" placeholder="Account Info" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += ' <div class="form-group col-md-2">';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group">';
        html += '<input type="text" name="payment_note[]" class="form-control m-input" placeholder="Note" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += ' <div class="form-group col-md-2">';
        html += '<div id="inputFormRow">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        $('#newPaymentRow').append(html);
        $('.select-2').select2();
    });
    
    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('.recentRow').remove();
    });

   // Payment Method
   // End Create Purchase
        $('.select-2').select2();
        // Date Picker
        jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker('setDate', 'now');
});
</script>
@endsection