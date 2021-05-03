@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.partials.flash')
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">All Supplier Type</h4>
                </div>
                <div class="col-7 align-self-center mb-2">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplierTypeAddModal" data-whatever="@mdo">Add Supplier</button>
                    </div>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table" id="supplierType">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Supplier Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($supplier_types as $supplier_type)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$supplier_type->supplier_type}}</td>
                                <td>{{$supplier_type->description}}</td>
                                <td>
                                    <a href="/" data-toggle="modal" data-target="#supplierTypeEditModal" onclick="riseSupplierTypeEditModal('{{$supplier_type->supplier_type}}','{{$supplier_type->description}}','{{$supplier_type->id}}')"><i class="font-18 far fa-edit text-info"></i></a>
                                    <a href="{{route('register.supplier.supplier-type.destroy',['supplier_type_id' => $supplier_type->id])}}"><i class="font-18 far fa-trash-alt text-danger"></i></a>
                                </td>
                            </tr>
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
@include('admin.pages.registers.suppliers.supplier-type.models.add-supplier-type')
@include('admin.pages.registers.suppliers.supplier-type.models.edit-supplier-type')
@endsection
@section('custom_styles')
@endsection
@section('custom_scripts')
<script>
    $('#supplierType').DataTable();
    function riseSupplierTypeEditModal(supplier_type,description,id){
      $('#hiddenSupplierTypeId').val(id);
       $('#supplierTypeEditModal input[name="supplier_type"]').val(supplier_type);
       $('#supplierTypeEditModal textarea[name="description"]').val(description);
    }
 </script>
@endsection
