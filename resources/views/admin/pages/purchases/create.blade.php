@extends('admin.master')
@section('custom_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css"/ >
<link rel="stylesheet" type="text/css" href="{{asset('backend')}}/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div style=";padding-top: 10px" class="row">
                    <div class="col-md-4">
                        <div style="margin-bottom: 5px" class="form-group row">
                            <label for="productname" class="col-md-4 col-form-label">Supplier *</label>
                            <div class="col-md-8">
                                <select class="select-2">
                                    <option value="2" data-select2-id="4">Walk-In Supplier Walk-In Supplier</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="margin-bottom: 5px" class="form-group row">
                            <label style="text-align: right" for="productname" class="col-md-4 col-form-label">Note </label>
                            <div class="col-md-8">
                                <input id="bill_note" name="bill_note" type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div style="margin-bottom: 5px" class="form-group row">
                            <label style="text-align: right" for="productname" class="col-md-4 col-form-label">Date * </label>
                            <div class="col-md-8">
                                <input id="selling_date" name="selling_date" type="text" value="21-05-2021" class="form-control" data-provide="datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: none">
                    <select style="padding: 6px;border-radius: 4px;cursor: pointer">
                        <option style="padding: 10px" value="1" selected="">BDT</option>
                        <option style="padding: 10px" value="0">%</option>
                    </select>
                    <input id="tax_amount_0" type="text" class="form-control width-xs taxAmount" name="tax_amount" value="0">
                </div>
                <div style="margin-top: 5px" class="row">
                    <div style="background-color: #D2D2D2;height: 280px;padding-top: 5px;overflow-y: auto;overflow-x: auto" class="col-md-12 input_fields_wrap getMultipleRow">
                    <div class="row">
                        <div class="col-12">
                            @php
                                $getSizeAttributeId = App\Models\ProductAttribute::where('attribute_name','Size')->first();
                                $getGradeAttributeId = App\Models\ProductAttribute::where('attribute_name','Grade')->first();
                            @endphp
                            <div class="row">
                                <div class="form-group col-md-2">
                                <label for="attributeName" class="col-form-label">Product</label>
                                    <div id="inputFormRow">
                                        <select class="form-control select-2"  name="size_attribute_id[]">
                                            @foreach (App\Models\AttributeValue::where('attribute_id',$getSizeAttributeId->id ?? '')->get() as $value)
                                                <option value="{{$value->id}}">{{$value->attribute_value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label for="attributeName" class="col-form-label">Box</label>
                                        <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                            <input type="text" name="variant_purchase_price[]" class="form-control m-input" placeholder="Box" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div id="inputFormRow">
                                    <label for="attributeName" class="col-form-label">Pcs</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="variant_purchase_price[]" class="form-control m-input" placeholder="Pcs" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div id="inputFormRow">
                                    <label for="attributeName" class="col-form-label">Qty(sft)</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="variant_sell_price[]" class="form-control m-input" placeholder="Quantity" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div id="inputFormRow">
                                    <label for="attributeName" class="col-form-label">Price</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="quantity[]" class="form-control m-input" placeholder="Price" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div id="inputFormRow">
                                    <label for="attributeName" class="col-form-label">%</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="quantity[]" class="form-control m-input" placeholder="Offer" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div id="inputFormRow">
                                    <label for="attributeName" class="col-form-label">Discount</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="quantity[]" class="form-control m-input" placeholder="Discount" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div id="inputFormRow">
                                    <label for="attributeName" class="col-form-label">Total</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="quantity[]" class="form-control m-input" placeholder="Total" autocomplete="off">
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
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('backend')}}/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-2').select2();
        $('#supplierTable').DataTable();
        // Date Picker
        jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker('setDate', 'now');
});
</script>
@endsection