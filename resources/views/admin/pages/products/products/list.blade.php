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
            </div>
                <div class="table-responsive">
                    <table class="table" id="productTable">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Categroy</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Pc's Per Box</th>
                                <th scope="col">Quantity(sft)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @forelse ($products as $product)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$product->product_name ?? ''}}</td>
                                    <td>{{$product->category->category_name ?? ''}}</td>
                                    <td>{{$product->brand->brand_name ?? ''}}</td>
                                    <td>{{$product->pcs_per_box ?? ''}}</td>
                                    <td>{{$product->alert_qty ?? ''}}</td>
                                    <td>
                                        <a href="{{route('product.product.edit',['product_id' => $product->id])}}">
                                            <i class="font-18 far fa-edit text-info"></i>
                                        </a>
                                        <a href="{{route('product.product.destroy',['product_id' => $product->id ?? ''])}}" class="mx-2">
                                            <i class="font-18 far fa-trash-alt text-danger"></i>
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
    $('#productTable').DataTable();
    $('.select-2').select2();
</script>

@endsection