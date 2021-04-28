@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.partials.flash')
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">All Attribute </h4>
                </div>
                <div class="col-7 align-self-center mb-2">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#attributeAddModal" data-whatever="@mdo">Add Attribute</button>
                    </div>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table" id="attributeTable">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Attribute Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attributes as $attribute)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$attribute->attribute_name}}</td>
                                    <td>
                                        <a href="/" data-toggle="modal" data-target="#attributeEditModal" onclick="riseAttributeEditModal('{{$attribute->attribute_name}}','{{$attribute->id}}')"><i class="font-18 far fa-edit text-info"></i></a>
                                        <a href="{{route('product.attribute.destroy',['attribute_id' => $attribute->id])}}"><i class="font-18 far fa-trash-alt text-danger"></i></a>
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
@include('admin.pages.products.attributes.modals.add-attribute')
@include('admin.pages.products.attributes.modals.edit-attribute')
@endsection
@section('custom_styles')
@endsection
@section('custom_scripts')
<script>
    $('#attributeTable').DataTable();
    function riseAttributeEditModal(attribute_name,id){
        $('#hiddenAttributeId').val(id);
       $('#attributeEditModal input[name="attribute_name"]').val(attribute_name);
    }
 </script>
@endsection
