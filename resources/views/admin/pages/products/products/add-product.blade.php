@extends('admin.master')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Product</h4>
            <div class="repeater-default m-t-30">
                <div data-repeater-list="">
                    <div data-repeater-item="">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="supplierName">Select Supplier <span class="text-danger">*</span></label>
                                    <select class="form-control select-2" id="supplierName" name="supplier_id" required>
                                        @foreach (App\Models\Supplier::all() as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}} | {{$supplier->organization_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="productCategory">Category</label>
                                    <select class="form-control select-2" id="productCategory" name="category_id">
                                        @foreach (App\Models\Category::all() as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="productBrand">Brand</label>
                                    <select class="form-control select-2" id="productBrand" name="brand_id">
                                        @foreach (App\Models\Brand::all() as $brand)
                                            <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="paymentMethod">Payment Method</label>
                                    <select class="form-control select-2" id="paymentMethod" name="brand_id" required>
                                        @foreach (App\Models\PaymentMethod::all() as $payment_method)
                                            <option value="{{$payment_method->id}}">{{$payment_method->method_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="productName">Product Name</label>
                                    <input type="text" class="form-control" id="productName" placeholder="Ex : A 02">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="productPcsPerBox">Pcs Per Box</label>
                                    <input type="number" class="form-control" id="productPcsPerBox" placeholder="Ex : 25">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="pwd">Product Type</label>
                                    <select name="product_type" class="form-control" id="getProductType"
                                        onchange="getProductTypeChoose()">
                                        <option value="single" select>Single</option>
                                        <option value="variable">Variable</option>
                                    </select>
                                </div>
                            </div>
                            <div  id="singleProduct">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="productPurchasePrice">Purchase Price</label>
                                        <input type="number" class="form-control" id="productPurchasePrice" placeholder="Ex : 35">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="productSellPrice">Sell Price</label>
                                        <input type="number" class="form-control" id="productSellPrice" placeholder="Ex : 38">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="quantity">Quantity(sft)</label>
                                        <input type="number" class="form-control" id="quantity" placeholder="Ex : 1200">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="alertQuantity">Alert Quantity</label>
                                        <input type="number" class="form-control" id="alertQuantity" placeholder="Ex : 400">
                                    </div>
                                </div>
                            </div>
                            <div id="variableProduct">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                <label for="attributeName" class="col-form-label">Select Attribute</label>
                                                    <div id="inputFormRow">
                                                        <select class="form-control select-2"  name="product_attribute[]">
                                                            @foreach (App\Models\ProductAttribute::all() as $attribute)
                                                                <option value="{{$attribute->id}}" onchange="changeProductAttribute('{{$attribute->id}}')">{{$attribute->attribute_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="attributeName" class="col-form-label">Select Attribute</label>
                                                     <div id="inputFormRow">
                                                        <select class="form-control select-2" id="attributeValue[]" name="attribute_value[]">
                                                            @foreach (App\Models\AttributeValue::all() as $value)
                                                                <option value="{{$value->id}}">{{$value->attribute_value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="inputFormRow">
                                                    <label for="attributeName" class="col-form-label">Purchase Price</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="attribute_value[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="inputFormRow">
                                                    <label for="attributeName" class="col-form-label">Sell Price</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="attribute_value[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="inputFormRow">
                                                    <label for="attributeName" class="col-form-label">Quantity (sft)</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="attribute_value[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">
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
                                            <div id="newRow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-success waves-effect waves-light" type="submit">Submit
                                </button>
                                <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light m-l-10" type="button">Delete Form
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


