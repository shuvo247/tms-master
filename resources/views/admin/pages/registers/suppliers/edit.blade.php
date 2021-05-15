@extends('admin.master')
@section('custom_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
<div class="row">
    {{-- Add Supplier  --}}
    <div class="col-12">
        @include('admin.partials.flash')
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Supplier</h4>
                <div class="repeater-default m-t-30">
                    <div data-repeater-list="">
                        <div data-repeater-item="">
                            <form action="{{route('register.supplier.update',['supplier_id' => $supplier->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="supplierName">Select Type <span class="text-danger">*</span></label>
                                        <select class="form-control select-2" id="supplierName" name="supplier_type" required>
                                            @foreach (App\Models\SupplierType::all() as $type)
                                                <option value="{{$type->id}}" @if($type == $supplier->supplier_type) selected @endif>{{$type->supplier_type}}</option>
                                            @endforeach
                                          </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="supplierName">Supplier Name <span class="text-danger">*</span></label>
                                        <input name="supplier_name" type="supplierName" class="form-control" id="text" value="{{$supplier->supplier_name ?? ''}}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="organization">Organization <span class="text-danger">*</span></label>
                                        <input name="organization" type="text" class="form-control" id="organization" value="{{$supplier->organization_name ?? ''}}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <textarea name="address" class="form-control" id="address" rows="1" required>{{$supplier->address ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="mobileNumber">Mobile Number <span class="text-danger">*</span></label>
                                        <input name="mobile_number" type="text" class="form-control" id="mobileNumber" value="{{$supplier->mobile_number ?? ''}}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="alternativeNumber">Alternative Number</label>
                                        <input name="alternative_mobile_number" type="text" class="form-control" id="alternativeNumber" value="{{$supplier->alternative_mobile_number ?? ''}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nidNumber">NID Number</label>
                                        <input name="nid_number" type="number" class="form-control" id="nidNumber" value="{{$supplier->nid_number ?? ''}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="image">Image</label>
                                        <input name="image" type="file">
                                    </div>
                                </div>
                            
                            <hr>
                        </div>
                    </div>
                    <button data-repeater-create="" class="btn btn-info waves-effect waves-light">Save Changes
                    </button>
                    <a href="{{route('register.supplier.list')}}" class="btn btn-secondary" data-dismiss="modal">Close</a>
                </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Add Supplier --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">All Supplier </h4>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table" id="supplierTable">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Supplier Type</th>
                                <th scope="col">Name</th>
                                <th scope="col">Organization</th>
                                <th scope="col">Address</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($suppliers as $supplier)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$supplier->supplier_type->supplier_type}}</td>
                                <td>{{$supplier->supplier_name}}</td>
                                <td>{{$supplier->organization_name}}</td>
                                <td>{{$supplier->address}}</td>
                                <td>{{$supplier->mobile_number}}</td>
                                <td>
                                    <a href="{{route('register.supplier.edit',['supplier_id' => $supplier->id])}}"><i class="font-18 far fa-edit text-info"></i></a>
                                    <a href=""><i class="font-18 far fa-trash-alt text-danger"></i></a>
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
@endsection
@section('custom_scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#supplierTable').DataTable();
        $('.supplier-type').select2();
        
});
</script>
@endsection