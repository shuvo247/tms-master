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
@include('admin.pages.products.products.add-product')
@endsection

@section('custom_scripts')
<script src="{{asset('backend/assets/js/select-2.js')}}"></script>
<script src="{{asset('backend/assets/js/custom/product.js')}}"></script>
<script>
    // Get Attribute Value
    function 
    // Select 2 and DataTable
    $('#productTable').DataTable();
    $('.select-2').select2();

</script>

@endsection