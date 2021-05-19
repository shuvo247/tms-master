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
                    <h4 class="page-title">All Product </h4>
                </div>
                <div class="col-7 align-self-center mb-2">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <a href="{{route('product.product.add')}}" class="btn btn-primary" data-whatever="@mdo">Add Product</a>
                    </div>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table" id="productTable">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Category Name</th>
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
@php
    $getSizeAttributeId = App\Models\ProductAttribute::where('attribute_name','Size')->first();
    $getGradeAttributeId = App\Models\ProductAttribute::where('attribute_name','Grade')->first();
@endphp
@include('admin.pages.products.products.add-product')
@endsection
@section('custom_scripts')
<script src="{{asset('backend/assets/js/select-2.js')}}"></script>
<script src="{{asset('backend/assets/js/custom/product.js')}}"></script>
<script>
    $('#singleProduct').css('display', 'block');
    $('#variableProduct').css('display', 'none');
    function getProductTypeChoose() {
        const producType = $("#getProductType").val();
        if (producType == 'single') {
            $('#singleProduct').css('display', 'block');
            $('#variableProduct').css('display', 'none');
        } else {
            $('#singleProduct').css('display', 'none');
            $('#variableProduct').css('display', 'block');
        }
    }
   $("#addRow").click(function () {
       var html = '';
       html += '<div class="recentRow col-12 row" style="margin:0;padding:0">';
       html += ' <div class="form-group col-md-2">';
       html += '<div id="inputFormRow">';
       html += '<div class="input-group mb-3">';
       html += '<select class="form-control select-2" name="size_attribute_id[]">';
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
       html += '<select class="form-control select-2" name="grade_attribute_id[]">';
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
       html += '<input type="text" name="variant_purchase_price[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">';
       html += '<div class="input-group-append">';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += ' <div class="form-group col-md-2">';
       html += '<div id="inputFormRow">';
       html += '<div class="input-group mb-3">';
       html += '<input type="text" name="variant_sell_price[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">';
       html += '<div class="input-group-append">';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += '</div>';
       html += ' <div class="form-group col-md-2">';
       html += '<div id="inputFormRow">';
       html += '<div class="input-group mb-3">';
       html += '<input type="text" name="quantity[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">';
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