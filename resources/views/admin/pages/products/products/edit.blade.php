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
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Product</h4>
            <div class="repeater-default m-t-30">
                <div data-repeater-list="">
                    <div data-repeater-item="">
                        <form action="{{route('product.product.update',['product_id' => $product->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <!-- <div class="form-group col-md-3">
                                    <label for="supplierName">Select Supplier <span class="text-danger">*</span></label>
                                    <select class="form-control select-2" id="supplierName" name="supplier_id" required>
                                        @foreach (App\Models\Supplier::all() as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}} | {{$supplier->organization_name}}</option>
                                        @endforeach
                                    </select>
                                </div> -->
                                <div class="form-group col-md-3">
                                    <label for="productCategory">Category <span class="text-danger">*</span></label>
                                    <select class="form-control select-2" id="productCategory" name="category_id">
                                        @foreach (App\Models\Category::all() as $category)
                                            <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="productBrand">Brand <span class="text-danger">*</span></label>
                                    <select class="form-control select-2" id="productBrand" name="brand_id">
                                        @foreach (App\Models\Brand::all() as $brand)
                                            <option value="{{$brand->id}}" @if($brand->id == $product->brand_id) selected @endif>{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- <div class="form-group col-md-3">
                                    <label for="paymentMethod">Payment Method <span class="text-danger">*</span></label>
                                    <select class="form-control select-2" id="paymentMethod" name="payment_method_id" required>
                                        @foreach (App\Models\PaymentMethod::all() as $payment_method)
                                            <option value="{{$payment_method->id}}">{{$payment_method->method_name}}</option>
                                        @endforeach
                                    </select>
                                </div> -->
                                <div class="form-group col-md-3">
                                    <label for="productName">Product Name <span class="text-danger">*</span></label>
                                    <input name="product_name" type="text" class="form-control" id="productName" value="{{$product->product_name ?? ''}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="productPcsPerBox">Pcs Per Box <span class="text-danger">*</span></label>
                                    <input name="pcs_per_box" type="number" class="form-control" id="productPcsPerBox" value="{{$product->pcs_per_box ?? ''}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="alertQuantity">Alert Quantity <span class="text-danger">*</span></label>
                                    <input name="alert_quantity" type="number" class="form-control" id="alertQuantity" value="{{$product->alert_qty ?? ''}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="Image">Image</label>
                                        <input type="file" name="image">
                                    </div>
                                <div class="form-group col-md-3">
                                    <label for="pwd">Product Type</label>
                                    <select name="product_type" class="form-control" id="getProductType"
                                        onchange="getProductTypeChoose()" disabled>
                                        <option value="single" @if($product->product_variant == 0) selected @endif>Single</option>
                                        <option value="variable" @if($product->product_variant == 1) selected @endif>Variable</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div  id="singleProduct" @if($product->product_variant == 1) style="display:none;" @endif>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="productPurchasePrice">Purchase Price</label>
                                        <input name="purchase_price" type="number" class="form-control" id="productPurchasePrice" value="{{$product->product_stock->purchase_price ?? ''}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="productSellPrice">Sell Price</label>
                                        <input name="sell_price" type="number" class="form-control" id="productSellPrice" value="{{$product->product_stock->selling_price ?? ''}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="quantity">Quantity(sft)</label>
                                        <input name="qty_in_sft" type="number" class="form-control" id="quantity" value="{{$product->product_stock->qty_in_sft ?? ''}}">
                                    </div>
                                </div>
                            </div>
                            <div id="variableProduct" @if($product->product_variant == 1) style="display:block;" @endif>
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                                $getSizeAttributeId = App\Models\ProductAttribute::where('attribute_name','Size')->first();
                                                $getGradeAttributeId = App\Models\ProductAttribute::where('attribute_name','Grade')->first();
                                            @endphp
                                            @foreach($product->variable_product_stock as $variable_stock)
                                            <div class="row @if($loop->index != 0)recentRow @endif">
                                                <div class="form-group col-md-2">
                                                @if($loop->index == 0)
                                                <label for="attributeName" class="col-form-label">Select Product Size</label>
                                                @endif
                                                    <input type="hidden" name="variable_product_id[]" value="{{$variable_stock->id}}">
                                                    <div id="inputFormRow">
                                                        <select class="form-control select-2"  name="size_attribute_id[]">
                                                            @foreach (App\Models\AttributeValue::where('attribute_id',$getSizeAttributeId->id ?? '')->get() as $value)
                                                                <option value="{{$value->id}}" @if($value->id == $variable_stock->size_attribute_id) selected @endif>{{$value->attribute_value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    @if($loop->index == 0)
                                                    <label for="attributeName" class="col-form-label">Select Product Grade</label>
                                                    @endif
                                                     <div id="inputFormRow">
                                                        <select class="form-control select-2" name="grade_attribute_id[]">
                                                            @foreach (App\Models\AttributeValue::where('attribute_id',$getGradeAttributeId->id ?? '')->get() as $value)
                                                                <option value="{{$value->id}}" @if($value->id == $variable_stock->grade_attribute_id) selected @endif>{{$value->attribute_value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="inputFormRow">
                                                    @if($loop->index == 0)
                                                    <label for="attributeName" class="col-form-label">Purchase Price</label>
                                                    @endif
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="variant_purchase_price[]" class="form-control m-input" value="{{$variable_stock->purchase_price ?? ''}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="inputFormRow">
                                                    @if($loop->index == 0)
                                                    <label for="attributeName" class="col-form-label">Sell Price</label>
                                                    @endif
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="variant_sell_price[]" class="form-control m-input" value="{{$variable_stock->selling_price ?? ''}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="inputFormRow">
                                                    @if($loop->index == 0)
                                                    <label for="attributeName" class="col-form-label">Quantity (sft)</label>
                                                    @endif
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="quantity[]" class="form-control m-input" value="{{$variable_stock->qty_in_sft}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    @if($loop->index == 0)
                                                    <label for="attributeName" class="col-form-label">Add Row</label>
                                                    <div class="ml-auto">
                                                        <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                                                    </div>
                                                    @else
                                                    <div class="inputFormRow">
                                                    <label for="attributeName" class="col-form-label"></label>
                                                        <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                            <div id="newRow" class="row">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-success waves-effect waves-light" type="submit">Submit
                                </button>
                                <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light m-l-10" type="button">Reset
                                </button>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@php
    $getSizeAttributeId = App\Models\ProductAttribute::where('attribute_name','Size')->first();
    $getGradeAttributeId = App\Models\ProductAttribute::where('attribute_name','Grade')->first();
@endphp
@section('custom_scripts')
<script src="{{asset('backend/assets/js/select-2.js')}}"></script>
<script src="{{asset('backend/assets/js/custom/product.js')}}"></script>
<script>
    // $('#singleProduct').css('display', 'block');
    // $('#variableProduct').css('display', 'none');
    // function getProductTypeChoose() {
    //     const producType = $("#getProductType").val();
    //     if (producType == 'single') {
    //         $('#singleProduct').css('display', 'block');
    //         $('#variableProduct').css('display', 'none');
    //     } else {
    //         $('#singleProduct').css('display', 'none');
    //         $('#variableProduct').css('display', 'block');
    //     }
    // }
   $("#addRow").click(function () {
       var html = '';
       html += '<div class="recentRow col-12 row" style="margin:0;padding:0">';
       html += ' <div class="form-group col-md-2">';
       html += '<div id="inputFormRow">';
       html += '<div class="input-group mb-3">';
       html += '<select class="form-control select-2" name="new_size_attribute_id[]">';
       html += '@foreach (App\Models\AttributeValue::where('attribute_id',$getSizeAttributeId->id ?? '')->get() as $value)';
       html += '<option value="{{$value->id}}">{{$value->attribute_value}}</option>';
       html += '@endforeach';
       html += '</select>'
       html += '<div class="input-group-append">';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += ' <div class="form-group col-md-2">';
       html += '<div id="inputFormRow">';
       html += '<div class="input-group mb-3">';
       html += '<select class="form-control select-2" name="new_grade_attribute_id[]">';
       html += '@foreach (App\Models\AttributeValue::where('attribute_id',$getGradeAttributeId->id ?? '')->get() as $value)';
       html += '<option value="{{$value->id}}">{{$value->attribute_value}}</option>';
       html += '@endforeach';
       html += '</select>'
       html += '<div class="input-group-append">';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += ' <div class="form-group col-md-2">';
       html += '<div id="inputFormRow">';
       html += '<div class="input-group mb-3">';
       html += '<input type="text" name="new_variant_purchase_price[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">';
       html += '<div class="input-group-append">';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += ' <div class="form-group col-md-2">';
       html += '<div id="inputFormRow">';
       html += '<div class="input-group mb-3">';
       html += '<input type="text" name="new_variant_sell_price[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">';
       html += '<div class="input-group-append">';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += ' <div class="form-group col-md-2">';
       html += '<div id="inputFormRow">';
       html += '<div class="input-group mb-3">';
       html += '<input type="text" name="new_quantity[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">';
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
       $('#newRow').append(html);
       $('.select-2').select2();
   });
 
   // remove row
   $(document).on('click', '#removeRow', function () {
       $(this).closest('.recentRow').remove();
   });
    // Select 2 and DataTable
    $('#productTable').DataTable();
    $('.select-2').select2();

</script>

@endsection