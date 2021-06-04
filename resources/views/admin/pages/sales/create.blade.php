@extends('admin.master')
@section('custom_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
        @include('admin.partials.flash')
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div style=";padding-top: 10px" class="row">
                        <div class="col-md-4">
                            <div style="margin-bottom: 5px" class="form-group row">
                                <label for="productname" class="col-md-4 col-form-label">Supplier *</label>
                                <div class="col-md-8">
                                    <select class="select-2" name="supplier_id">
                                        @foreach(App\Models\Supplier::all() as $supplier)
                                            <option value="{{ $supplier->id }}" >{{ $supplier->organization->organization_name}} | {{$supplier->supplier_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="margin-bottom: 5px" class="form-group row">
                                <label style="text-align: right" for="productname" class="col-md-4 col-form-label">Note </label>
                                <div class="col-md-8">
                                    <input id="sales_note" name="sales_note" type="text" placeholder="Sales note" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="margin-bottom: 5px" class="form-group row">
                                <label style="text-align: right" for="productname" class="col-md-4 col-form-label">Date * </label>
                                <div class="col-md-8">
                                    <input id="sales_date" name="sales_date" type="text" class="form-control" data-date-autoclose="true" >
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
                                                <input type="text" name="sales_box[]" id="salesBoxValue" class="form-control m-input" placeholder="Box" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Pcs</label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="salesPcsValue" name="sales_pcs[]" class="form-control m-input" placeholder="Pcs" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Qty(sft)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="salesQtyValue" name="sales_quantity[]" class="form-control m-input" placeholder="Quantity" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Price</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="sales_price[]" id="salesPrice" class="form-control m-input" placeholder="Price" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Dis. Type</label>
                                            <div class="input-group mb-3">
                                                <select name="" id="discountType" class="form-control">
                                                    <option value="parcent">%</option>
                                                    <option value="bdt">BDT</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Discount</label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="salesDiscountValue" name="discount[]" class="form-control m-input" placeholder="Discount" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div id="inputFormRow">
                                        <label for="attributeName" class="col-form-label">Total</label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="salesProductTotal" name="total[]" class="form-control m-input total" placeholder="Total" autocomplete="off">
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
                    <div class="col-md-6" style="background-color: #D2D2D2;height: 200px;padding-top: 5px;overflow-y: auto;overflow-x: auto">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                    <label for="attributeName" class="col-form-label">Paid</label>
                                        <div id="inputFormRow">
                                            <input type="number" name="sales_paid[]" class="form-control">
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
                                                <input type="text" name="sales_note[]" class="form-control m-input" placeholder="Note" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="attributeName" class="col-form-label">Add Row</label>
                                        <div class="ml-auto">
                                            <button id="addSalesRow" type="button" class="btn btn-info">Add Row</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="newSalesRow" class="row">
                                    
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
                                    <select style="border-radius: 4px;cursor: pointer" class="form-control" name="vat_type">
                                        <option style="padding: 10px" value="0" selected="">%</option>
                                        <option style="padding: 10px" value="1">BDT</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input id="sales_vat_amount" type="text" class="form-control width-xs" name="sales_vat_amount" value="">
                                </div>
                            </div><div style="margin-bottom: 5px" class="form-group row">
                                <label style="text-align: right" class="col-md-5 col-form-label">Discount</label>
                                <div style="padding-right: 0px" class="col-md-3">
                                    <select style="border-radius: 4px;cursor: pointer" class="form-control totalDiscountType" name="total_discount_type">
                                        <option style="padding: 10px" value="1" selected="">BDT</option>
                                        <option style="padding: 10px" value="0">%</option>
                                    </select>
                                </div>

                                <div style="padding-left: 0px" class="col-md-4">
                                    <input id="sales_total_discount" type="text" class="form-control totalDiscount" name="sales_total_discount">
                                </div>
                            </div>
                            <div style="margin-bottom: 5px" class="form-group row">
                                <label style="text-align: right" class="col-md-5 col-form-label">Dis. Note</label>
                                <div class="col-md-7">
                                    <input id="discount_note" type="text" class="form-control width-xs" name="discount_note" placeholder="Discount Note">
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
                                <input type="text" id="totalPayable" name="total_amount" class="form-control">
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
    // Calculate Total and Subtotal
    // End Calculate Total and Subtotal
    $('#selectedProduct').change(function(){
    // Get Product Details
       var productId = $(this).val();
       $.get("{{route('sales.product_details')}}",{
           product_id : productId
           },function(data){
            $('#Stock').empty().html(data);
        });
        $.get("{{route('sales.product_info')}}",{
           product_id : productId
           },function(data){
            $('#salesPrice').val(data.purchase_price);
        });
    });
    // Purchase Discount Start
    $('#salesDiscountValue').keyup(function(){
        var parcentType = $('#discountType').val();
        var discountValue = $(this).val();

        // Get Old Purchase Price
        var price = $('#salesPrice').val();
        var sft = $('#salesQtyValue').val();
        var salesTotal = parseFloat(price*sft).toFixed(2);
        // End Get Old sales Price
        // Update Total sales Price
        $('#salesProductTotal').val(salesTotal);
        if(parcentType == 'parcent'){
            var discountPrice = ((discountValue*salesTotal)/100);
            var calculateDiscountValue = parseFloat(salesTotal-discountPrice).toFixed(2);
            $('#purchaseProductTotal').val(calculateDiscountValue);
        }else{
            var calculateDiscountValue = parseFloat(salesTotal-discountValue).toFixed(2);
            $('#purchaseProductTotal').val(calculateDiscountValue);
        }
        // End Update Total Purchase Price
        // Calculate Sub Total Value
        var total = 0;
        $('.total').each(function(){
            total += parseFloat(this.value);
        });
        var sum = parseFloat(total).toFixed(2);
        $('#subTotalBdt').val(sum);
        $('#totalPayable').val(sum);
        // End Calculate Sub Total Value
    });
    // Purchase Discount End

    // Box Update Calculation
    // End Get Product Details
    $('#salesBoxValue').keyup(function(){
        var sftInABox = $('#sftInABox').text();
        var box = $(this).val();
        var salesPrice = $('#salesPrice').val();
        var sft = box*sftInABox;
        var frontSft = parseFloat(box*sftInABox).toFixed(2);
        $('#salesQtyValue').val(frontSft);
        // Show Price In Price Box
        var salesTotal = parseFloat(salesPrice*sft).toFixed(2);
        $('#salesProductTotal').val(salesTotal);
        // Calculate Sub Total Value
        var total = 0;
        $('.total').each(function(){
            total += parseFloat(this.value);
        });
        var sum = parseFloat(total).toFixed(2);
        $('#subTotalBdt').val(sum);
        $('#totalPayable').val(sum);
        // End Calculate Sub Total Value
    });
    // Pcs Update Calculation
    $('#salesPcsValue').keyup(function(){
        var salesQtyValue =$('#salesQtyValue').val();
        var salesBoxValue = $('#salesBoxValue').val();
        var salesPrice = $('#salesPrice').val();
        var sftInABox = $('#sftInABox').text();
        var salesPcsValue = $(this).val();
        var SftInAPcs = $('#sftInAPcs').text();
        var PcsToSft = SftInAPcs*salesPcsValue;
        var boxToSft = salesBoxValue*sftInABox;
        var TotalSft = PcsToSft+boxToSft;
        var frontTotalSft = parseFloat(PcsToSft+boxToSft).toFixed(2);
        $('#salesQtyValue').val(frontTotalSft);
        var salesTotal = parseFloat(salesPrice*TotalSft).toFixed(2);
        $('#salesProductTotal').val(salesTotal);
        // Calculate Sub Total Value
        var total = 0;
        $('.total').each(function(){
            total += parseFloat(this.value);
        });
        var sum = parseFloat(total).toFixed(2);
        $('#subTotalBdt').val(sum);
        $('#totalPayable').val(sum);
        // End Calculate Sub Total Value
    });
    // Quantity Update Calculation
    $('#salesQtyValue').keyup(function(){
        // Get Some data for calculate
        var sftInABox = $('#sftInABox').text();
        var sft = $(this).val();
        var salesPrice = $('#salesPrice').val();
        // Calculation Start
        var salesBox = sft/sftInABox; // Purchase Box
        $('#salesBoxValue').val(sft/sftInABox | 0); // Get purchase Box Integer Value
        var flotingBox = salesBox - Math.floor(salesBox); // Seperate Floting Value from Purchase Box
        var flotingBoxToSft = flotingBox*sftInABox; // Conver Floting Box to Sft
        var SftInAPcs = $('#sftInAPcs').text();
        var frontSalesPcsValue = parseFloat(flotingBoxToSft/SftInAPcs).toFixed(2);
        var flotingBox = parseFloat(frontSalesPcsValue - Math.floor(frontSalesPcsValue)).toFixed(2); // Seperate Floting Value from Purchase Box
        if(flotingBox != 0.00){
           $('#salesPcsValue').css('border-color','red');
        }else{
            $('#salesPcsValue').css('border-color',''); 
        }
        $('#salesPcsValue').val(frontSalesPcsValue); // Convert and show floting box to PCS
        // Show Price In Price Box
        var salesTotal = parseFloat(salesPrice*sft).toFixed(2);
        $('#salesProductTotal').val(salesTotal);
        // Calculate Sub Total Value
        var total = 0;
        $('.total').each(function(){
            total += parseFloat(this.value);
        });
        var sum = parseFloat(total).toFixed(2);
        $('#subTotalBdt').val(sum);
        $('#totalPayable').val(sum);
        // End Calculate Sub Total Value
    });
    // Calculate Box Value
    // Price Update Calculation
    $('#salesPrice').keyup(function(){
        var price = $(this).val();
        var sft = $('#salesQtyValue').val();
        var salesTotal = parseFloat(price*sft).toFixed(2);
        $('#salesProductTotal').val(salesTotal);
        // Calculate Sub Total Value
        var total = 0;
        $('.total').each(function(){
            total += parseFloat(this.value);
        });
        var sum = parseFloat(total).toFixed(2);
        $('#subTotalBdt').val(sum);
        $('#totalPayable').val(sum);
        // End Calculate Sub Total Value
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
            html += '<option> -- Select Product -- </option>';
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
            html += '@include("admin.pages.purchases.stock")';
            html += '</div>'
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text" name="sales_box[]" id="salesBoxValue'+j+'" class="form-control m-input" placeholder="Box" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text"  id="salesPcsValue'+j+'" name="sales_pcs[]" class="form-control m-input" placeholder="Pcs" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text"  id="salesQtyValue'+j+'" name="sales_quantity[]" class="form-control m-input" placeholder="Quantity" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-1">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text"  id="salesPrice'+j+'" name="sales_price[]" id="salesPrice'+j+'" class="form-control m-input" placeholder="Price" autocomplete="off">';
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
            html += '<input type="text" id="salesDiscountValue'+j+'" name="discount[]" class="form-control m-input" placeholder="Discount" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += ' <div class="form-group col-md-2">';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input type="text" name="total[]" id="salesProductTotal'+j+'" class="form-control m-input total" placeholder="Total" autocomplete="off">';
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
        $.get("{{route('sales.product_details')}}",{
            product_id : productId,
            id_value : j
            },function(data){
                $('#Stock'+j).empty().html(data);
            });
            $.get("{{route('sales.product_info')}}",{
            product_id : productId
            },function(data){
                $('#salesPrice'+j).val(data.purchase_price);
            });
        });
        // Purchase Box Value for Dynamic Row
        // $("#purchaseBoxValue"+j).keyup(function(){
        //     var sftInABox = $('#sftInABox').text();
        //     var box = $(this).val();
        //     var purchasePrice = $('#purchasePrice'+j).val();
        //     var purchaseTotal = parseFloat(sftInABox*box*purchasePrice).toFixed(2);
        //     $('#purchaseProductTotal'+j).val(purchaseTotal);
        // });
    // End Purchase Box Value for Dynamic Row
    // End Get Product Details

     // Purchase Discount Start
     $('#salesDiscountValue').keyup(function(){
        var parcentType = $('#discountType').val();
        var discountValue = $(this).val();

        // Get Old Purchase Price
        var price = $('#salesPrice').val();
        var sft = $('#salesQtyValue').val();
        var salesTotal = parseFloat(price*sft).toFixed(2);
        // End Get Old Purchase Price
        // Update Total Purchase Price
        $('#salesProductTotal').val(salesTotal);
        if(parcentType == 'parcent'){
            var discountPrice = ((discountValue*salesTotal)/100);
            var calculateDiscountValue = parseFloat(salesTotal-discountPrice).toFixed(2);
            $('#purchaseProductTotal').val(calculateDiscountValue);
        }else{
            var calculateDiscountValue = parseFloat(salesTotal-discountValue).toFixed(2);
            $('#salesProductTotal').val(calculateDiscountValue);
        }
        // End Update Total Purchase Price
        // Calculate Sub Total Value
        var total = 0;
        $('.total').each(function(){
            total += parseFloat(this.value);
        });
        var sum = parseFloat(total).toFixed(2);
        $('#subTotalBdt').val(sum);
        $('#totalPayable').val(sum);
        // End Calculate Sub Total Value
    });
    
    $('#salesBoxValue'+j).keyup(function(){
        var sftInABox = $('#sftInABox'+j).text();
        var box = $(this).val();
        var salesPrice = $('#salesPrice'+j).val();
        var sft = parseFloat(box*sftInABox).toFixed(2);
        var frontSft = parseFloat(box*sftInABox).toFixed(2);
        $('#salesQtyValue'+j).val(frontSft);
        // Show Price In Price Box
        var salesTotal = parseFloat(salesPrice*sft).toFixed(2);
        $('#salesProductTotal'+j).val(salesTotal);
        // Calculate Sub Total Value
        var total = 0;
        $('.total').each(function(){
            total += parseFloat(this.value);
        });
        var sum = parseFloat(total).toFixed(2);
        $('#subTotalBdt').val(sum);
        $('#totalPayable').val(sum);
        // End Calculate Sub Total Value
    });
    // Pcs Update Calculation
    $('#salesPcsValue'+j).keyup(function(){
        var salesQtyValue =$('#salesQtyValue'+j).val();
        var salesBoxValue = $('#salesBoxValue'+j).val();
        var salesPrice = $('#salesPrice'+j).val();
        var sftInABox = $('#sftInABox'+j).text();
        var salesPcsValue = $(this).val();
        var SftInAPcs = $('#sftInAPcs'+j).text();
        var PcsToSft = SftInAPcs*salesPcsValue;
        var boxToSft = salesBoxValue*sftInABox;
        var TotalSft =PcsToSft+boxToSft;
        var frontTotalSft = parseFloat(PcsToSft+boxToSft).toFixed(2);
        $('#salesQtyValue'+j).val(frontTotalSft);
        var salesTotal = parseFloat(salesPrice*TotalSft).toFixed(2);
        $('#salesProductTotal'+j).val(salesTotal);
        // Calculate Sub Total Value
        var total = 0;
        $('.total').each(function(){
            total += parseFloat(this.value);
        });
        var sum = parseFloat(total).toFixed(2);
        $('#subTotalBdt').val(sum);
        $('#totalPayable').val(sum);
        // End Calculate Sub Total Value
    });
    // Quantity Update Calculation
    $('#salesQtyValue'+j).keyup(function(){
        // Get Some data for calculate
        var sftInABox = $('#sftInABox'+j).text();
        var sft = $(this).val();
        var salesPrice = $('#salesPrice'+j).val();
        // Calculation Start
        var salesBox = sft/sftInABox; // Purchase Box
        $('#salesBoxValue'+j).val(sft/sftInABox | 0); // Get purchase Box Integer Value
        var flotingBox = salesBox - Math.floor(salesBox); // Seperate Floting Value from Purchase Box
        var flotingBoxToSft = flotingBox*sftInABox; // Conver Floting Box to Sft
        var SftInAPcs = $('#sftInAPcs'+j).text();
        var frontSalesPcsValue = parseFloat(flotingBoxToSft/SftInAPcs).toFixed(2);
        var flotingBox = parseFloat(frontSalesPcsValue - Math.floor(frontSalesPcsValue)).toFixed(2); // Seperate Floting Value from Purchase Box
        if(flotingBox != 0.00){
           $('#salesPcsValue'+j).css('border-color','red');
        }else{
            $('#salesPcsValue'+j).css('border-color',''); 
        }
        $('#salesPcsValue'+j).val(frontSalesPcsValue); // Convert and show floting box to PCS
        // Show Price In Price Box
        var salesTotal = parseFloat(salesPrice*sft).toFixed(2);
        $('#salesProductTotal'+j).val(salesTotal);
        // Calculate Sub Total Value
        var total = 0;
        $('.total').each(function(){
            total += parseFloat(this.value);
        });
        var sum = parseFloat(total).toFixed(2);
        $('#subTotalBdt').val(sum);
        $('#totalPayable').val(sum);
        // End Calculate Sub Total Value
    });
    // Calculate Box Value
    // Price Update Calculation
    $('#salesPrice'+j).keyup(function(){
        var price = $(this).val();
        var sft = $('#salesQtyValue'+j).val();
        var salesTotal = parseFloat(price*sft).toFixed(2);
        $('#salesProductTotal'+j).val(salesTotal);
        // Calculate Sub Total Value
        var total = 0;
        $('.total').each(function(){
            total += parseFloat(this.value);
        });
        var sum = parseFloat(total).toFixed(2);
        $('#subTotalBdt').val(sum);
        $('#totalPayable').val(sum);
        // End Calculate Sub Total Value
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
        html += '<input name="sales_paid[]" type="text" class="form-control">';
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
    jQuery('.mydatepicker, #purchase_date, .input-group.date').datepicker("setDate",'1d');

});
</script>
@endsection