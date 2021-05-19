@extends('admin.master')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Product</h4>
            <div class="repeater-default m-t-30">
                <div data-repeater-list="">
                    <div data-repeater-item="">
                        <form action="{{route('product.product.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="supplierName">Select Supplier <span class="text-danger">*</span></label>
                                    <select class="form-control select-2" id="supplierName" name="supplier_id" required multiple>
                                        @foreach (App\Models\Supplier::all() as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}} | {{$supplier->organization_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="productCategory">Category <span class="text-danger">*</span></label>
                                    <select class="form-control select-2" id="productCategory" name="category_id" multiple>
                                        @foreach (App\Models\Category::all() as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="productBrand">Brand <span class="text-danger">*</span></label>
                                    <select class="form-control select-2" id="productBrand" name="brand_id">
                                        @foreach (App\Models\Brand::all() as $brand)
                                            <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="paymentMethod">Payment Method <span class="text-danger">*</span></label>
                                    <select class="form-control select-2" id="paymentMethod" name="payment_method_id" required>
                                        @foreach (App\Models\PaymentMethod::all() as $payment_method)
                                            <option value="{{$payment_method->id}}">{{$payment_method->method_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="productName">Product Name <span class="text-danger">*</span></label>
                                    <input name="product_name" type="text" class="form-control" id="productName" placeholder="Ex : A 02">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="productPcsPerBox">Pcs Per Box <span class="text-danger">*</span></label>
                                    <input name="pcs_per_box" type="number" class="form-control" id="productPcsPerBox" placeholder="Ex : 25">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="alertQuantity">Alert Quantity <span class="text-danger">*</span></label>
                                    <input name="alert_quantity" type="number" class="form-control" id="alertQuantity" placeholder="Ex : 400">
                                </div>
                                <!-- <div class="form-group col-md-3">
                                    <label for="alertQuantity">Image</label>
                                        <input type="file" name="image">
                                    </div> -->
                                <div class="form-group col-md-3">
                                    <label for="pwd">Product Type</label>
                                    <select name="product_type" class="form-control" id="getProductType"
                                        onchange="getProductTypeChoose()">
                                        <option value="single" selected>Single</option>
                                        <option value="variable">Variable</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div  id="singleProduct">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="productPurchasePrice">Purchase Price</label>
                                        <input name="purchase_price" type="number" class="form-control" id="productPurchasePrice" placeholder="Ex : 35">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="productSellPrice">Sell Price</label>
                                        <input name="sell_price" type="number" class="form-control" id="productSellPrice" placeholder="Ex : 38">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="quantity">Quantity(sft)</label>
                                        <input name="qty_in_sft" type="number" class="form-control" id="quantity" placeholder="Ex : 1200">
                                    </div>
                                </div>
                            </div>
                            <div id="variableProduct">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                                $getSizeAttributeId = App\Models\ProductAttribute::where('attribute_name','Size')->first();
                                                $getGradeAttributeId = App\Models\ProductAttribute::where('attribute_name','Grade')->first();
                                            @endphp
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                <label for="attributeName" class="col-form-label">Select Product Size</label>
                                                    <div id="inputFormRow">
                                                        <select class="form-control select-2"  name="size_attribute_id[]">
                                                            @foreach (App\Models\AttributeValue::where('attribute_id',$getSizeAttributeId->id ?? '')->get() as $value)
                                                                <option value="{{$value->id}}">{{$value->attribute_value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="attributeName" class="col-form-label">Select Product Grade</label>
                                                     <div id="inputFormRow">
                                                        <select class="form-control select-2" name="grade_attribute_id[]">
                                                            @foreach (App\Models\AttributeValue::where('attribute_id',$getGradeAttributeId->id ?? '')->get() as $value)
                                                                <option value="{{$value->id}}">{{$value->attribute_value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="inputFormRow">
                                                    <label for="attributeName" class="col-form-label">Purchase Price</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="variant_purchase_price[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="inputFormRow">
                                                    <label for="attributeName" class="col-form-label">Sell Price</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="variant_sell_price[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="inputFormRow">
                                                    <label for="attributeName" class="col-form-label">Quantity (sft)</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="quantity[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
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


