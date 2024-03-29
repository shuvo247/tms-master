@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.partials.flash')
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Add Attribute </h4>
                </div>
            </div>
            <form action="{{route('product.attribute.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="attributeName" class="col-form-label">Select Attribute</label>
                    <select name="attribute_name" id="attributeName" class="form-control">
                        <option value="Size">Size</option>
                        <option value="Grade">Grade</option>
                    </select>
                </div>
                    <div id="inputFormRow">
                        <label for="attributeName" class="col-form-label">Attribute Value</label>
                        <div class="input-group mb-3">
                            <input type="text" name="attribute_value[]" class="form-control m-input" placeholder="Ex: 20X30cm, Grade-A" autocomplete="off">
                            <div class="input-group-append">                
                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    </div>
              <div id="newRow"></div>
              <div class="ml-auto">
                <button id="addRow" type="button" class="btn btn-info" style="margin-left: 44%;">Add Row</button>
              </div>
              <hr>
                <div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">All Attribute </h4>
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
                                    <td>{{$attribute->attribute_name ?? ''}}</td>
                                    <td>
                                        <a href="{{route('product.attribute.edit',['attribute_id' => $attribute->id])}}"><i class="font-18 far fa-edit text-info"></i></a>
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
<style>
    #inputFormRow{
        width: 50%;
    }
</style>

@endsection
@section('custom_scripts')
<script>
    $('#attributeTable').DataTable();
    function riseAttributeEditModal(attribute_name,id){
        $('#hiddenAttributeId').val(id);
       $('#attributeEditModal input[name="attribute_name"]').val(attribute_name);
    }
 </script>
 <script type="text/javascript">
   $("#addRow").click(function () {
       var html = '';
       html += '<div id="inputFormRow">';
       html += '<div class="input-group mb-3">';
       html += '<input type="text" name="attribute_value[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">';
       html += '<div class="input-group-append">';
       html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
       html += '</div>';
       html += '</div>';
       $('#newRow').append(html);
   });
 
   // remove row
   $(document).on('click', '#removeRow', function () {
       $(this).closest('#inputFormRow').remove();
   });
 </script>
@endsection
