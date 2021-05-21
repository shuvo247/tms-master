@extends('admin.master')
@section('custom_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="row">
    {{-- Add Organization  --}}
    <div class="col-12">
        @include('admin.partials.flash')
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Organization</h4>
                <div class="repeater-default m-t-30">
                    <div data-repeater-list="">
                        <div data-repeater-item="">
                            <form action="{{route('register.organization.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="supplierName">Select Type <span class="text-danger">*</span></label>
                                        <select class="form-control select-2" id="supplierName" name="organization_type">
                                            @foreach (App\Models\SupplierType::all() as $type)
                                                <option value="{{$type->id}}">{{$type->supplier_type}}</option>
                                            @endforeach
                                          </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="supplierName">Organization Name <span class="text-danger">*</span></label>
                                        <input name="organization_name" type="supplierName" class="form-control" id="text" placeholder="Ex : Color Ceramics Ltd">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="owner_name">Owner Name <span class="text-danger">*</span></label>
                                        <input name="owner_name" type="text" class="form-control" id="owner_name" placeholder="Ex: John Doe">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <textarea name="address" class="form-control" id="address" rows="1" placeholder="Ex: 38 North Jatrabari,Dhaka"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="mobileNumber">Mobile Number <span class="text-danger">*</span></label>
                                        <input name="mobile_number" type="text" class="form-control" id="mobileNumber" placeholder="Ex: 01777777777">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="image">Trade Licence</label>
                                        <input name="trade_licence" type="file">
                                    </div>
                                </div>
                            <hr>
                        </div>
                    </div>
                    <button data-repeater-create="" class="btn btn-info waves-effect waves-light">Save Changes
                    </button>
                    <a href="{{route('register.organization.list')}}" class="btn btn-secondary" data-dismiss="modal">Close</a>
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
                    <h4 class="page-title">All Organization </h4>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table" id="organizationTable">
                        <thead>
                            <tr>
                                <th scope="col">S.I</th>
                                <th scope="col">Organization Type</th>
                                <th scope="col">Organization</th>
                                <th scope="col">Owner Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($organizations as $organization)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$organization->supplier_type->supplier_type ?? ''}}</td>
                                <td>{{$organization->organization_name ?? ''}}</td>
                                <td>{{$organization->owner_name ?? ''}}</td>
                                <td>{{$organization->address ?? ''}}</td>
                                <td>{{$organization->phone ?? ''}}</td>
                                <td>
                                    <!-- <a href="{{route('register.organization.show',['organization_id' => $organization->id ?? ''])}}"><i class="font-18 far fa-eye text-info"></i></a> -->
                                    <a href="{{route('register.organization.edit',['organization_id' => $organization->id ?? ''])}}" class="mx-2"><i class="font-18 far fa-edit text-info"></i></a>
                                    <a href="{{route('register.organization.destroy',['organization_id' => $organization->id ?? ''])}}"><i class="font-18 far fa-trash-alt text-danger"></i></a>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-2').select2();
        $('#organizationTable').DataTable();
});
</script>
@endsection