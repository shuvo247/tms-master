@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.partials.flash')
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">All Brands </h4>
                </div>
                <div class="col-7 align-self-center mb-2">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#brandAddModal" data-whatever="@mdo">Add Brand</button>
                    </div>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table" id="brandTable">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$brand->brand_name}}</td>
                                    <td>
                                        <a href="/" data-toggle="modal" data-target="#brandEditModal" onclick="riseBrandEditModal('{{$brand->brand_name}}','{{$brand->id}}')"><i class="font-18 far fa-edit text-info"></i></a>
                                        <a href="{{route('product.brand.destroy',['brand_id' => $brand->id])}}"><i class="font-18 far fa-trash-alt text-danger"></i></a>
                                    </td>
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
@include('admin.pages.products.brands.modals.add-brand')
@include('admin.pages.products.brands.modals.edit-brand')
@endsection
@section('custom_styles')
@endsection
@section('custom_scripts')
<script>
    $('#brandTable').DataTable();
    function riseBrandEditModal(brand_name,id){
        $('#hiddenBrandId').val(id);
       $('#brandEditModal input[name="brand_name"]').val(brand_name);
    }
 </script>
@endsection