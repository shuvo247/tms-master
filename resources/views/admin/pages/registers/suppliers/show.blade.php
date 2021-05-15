@extends('admin.master')
@section('content')
<div class="col-6 offset-3">
    <div class="card">
        <div class="card-body">
            <center class="m-t-30"> <img src="{{ asset('uploads/'.$supplier->image) ?? asset('backend/assert/images/users/5.jpg')}}"  class="rounded-circle" width="150">
                
                <h4 class="card-title m-t-10">{{$supplier->supplier_name ?? ''}}</h4>
                <h6>{{$supplier->organization_name ?? ''}} ({{$supplier->supplier_type->supplier_type ?? ''}})</h6>
                
            </center>
        </div>
        <div>
            <hr> </div>
        <div class="card-body"> 
        <table class="table browser m-t-30 no-border">
            <tbody>
                <tr>
                    <td>Mobile Number</td>
                    <td align="right">{{$supplier->mobile_number ?? ''}}</td>
                </tr>
                <tr>
                    <td>Alternative Mobile</td>
                    <td align="right">{{$supplier->alternative_mobile_number ?? ''}}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td align="right">{{$supplier->address ?? ''}}</td>
                </tr>
                <tr>
                    <td>NID Number</td>
                    <td align="right">{{$supplier->nid_number ?? ''}}</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection