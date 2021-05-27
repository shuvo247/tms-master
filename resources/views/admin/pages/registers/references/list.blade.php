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
                <h4 class="card-title">Add New Reference</h4>
                <div class="repeater-default m-t-30">
                    <div data-repeater-list="">
                        <div data-repeater-item="">
                            <form action="{{route('register.reference.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="organization">Select Organization <span class="text-danger">*</span></label>
                                        <select class="form-control select-2" id="organization" name="organization_id">
                                            @foreach (App\Models\Organization::all() as $organization)
                                                <option value="{{$organization->id}}">{{$organization->organization_name}} | {{ $organization->supplier_type->supplier_type }}</option>
                                            @endforeach
                                          </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="referrerName">Referrer Name <span class="text-danger">*</span></label>
                                        <input name="referrer_name" type="text" class="form-control" id="referrerName" placeholder="Ex: John Doe">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <input name="address" type="text" class="form-control" id="address" placeholder="Ex: North Jatrabari, Dhaka">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="mobileNumber">Mobile Number <span class="text-danger">*</span></label>
                                        <input name="mobile_number" type="text" class="form-control" id="mobileNumber" placeholder="Ex: 01777777777">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="alternativeMobile">Alternative Mobile <span class="text-danger">*</span></label>
                                        <input name="alternative_mobile_number" type="text" class="form-control" id="alternativeMobile" placeholder="Ex: 01777777777">
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
                    <a href="{{route('register.reference.list')}}" class="btn btn-secondary" data-dismiss="modal">Close</a>
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
                                <th scope="col">Organization</th>
                                <th scope="col">Organization</th>
                                <th scope="col">Address</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Alternative Mobile</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($referencess as $references)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$references->organization->organization_name ?? ''}}</td>
                                <td>{{$references->referrer_name ?? ''}}</td>
                                <td>{{$references->address ?? ''}}</td>
                                <td>{{$references->mobile_number ?? ''}}</td>
                                <td>{{$references->alternative_mobile_number ?? ''}}</td>
                                <td>
                                    <!-- <a href="{{route('register.organization.show',['organization_id' => $organization->id ?? ''])}}"><i class="font-18 far fa-eye text-info"></i></a> -->
                                    <a href="{{route('register.reference.edit',['reference_id' => $references->id ?? ''])}}" class="mx-2"><i class="font-18 far fa-edit text-info"></i></a>
                                    <a href="{{route('register.reference.destroy',['reference_id' => $references->id ?? ''])}}"><i class="font-18 far fa-trash-alt text-danger"></i></a>
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