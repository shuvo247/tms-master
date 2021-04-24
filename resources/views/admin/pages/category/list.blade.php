@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.partials.flash')
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">All Categories </h4>
                </div>
                <div class="col-7 align-self-center mb-2">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryAddModal" data-whatever="@mdo">Add Category</button>
                    </div>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table" id="categoryTable">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#categoryEditModal" onclick="riseCategoryEditModal('{{$category->category_name}}','{{$category->id}}')"><i class="font-18 far fa-edit text-info"></i></a>
                                        <a href="{{route('category.destroy',['category_id' => $category->id])}}"><i class="font-18 far fa-trash-alt text-danger"></i></a>
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
@include('admin.pages.category.modals.add-category')
@include('admin.pages.category.modals.edit-category')
@endsection
@section('custom_styles')
@endsection
@section('custom_scripts')
<script>
    $('#categoryTable').DataTable();
    function riseCategoryEditModal(category_name,id){
        Swal.fire({
            title: 'Error!',
            text: 'Do you want to continue',
            icon: 'error',
            confirmButtonText: 'Cool'
        });
       $('#categoryEditModal input[name="category_name"]').val(category_name);
    }
 </script>
@endsection