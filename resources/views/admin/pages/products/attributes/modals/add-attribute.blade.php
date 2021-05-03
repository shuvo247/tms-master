<div class="modal fade" id="attributeAddModal" tabindex="-1" role="dialog" aria-labelledby="attributeAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="attributeAddModal">Add Attribute</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('product.attribute.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="attributeName" class="col-form-label">Product Attribute Name <span class="text-danger">*</span></label>
              <input name="attribute_name" type="text" class="form-control" id="attributeName" placeholder="Attribute Name">
            </div>
            <div id="inputFormRow">
              <label for="attributeName" class="col-form-label">Attribute Value <span class="text-danger">*</span></label>
              <div class="input-group mb-3">
                  <input type="text" name="attribute_value[]" class="form-control m-input" placeholder="Enter Value" autocomplete="off">
                  <div class="input-group-append">                
                      <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                  </div>
              </div>
            </div>
          <div id="newRow"></div>
          <div class="ml-auto">
            <button id="addRow" type="button" class="btn btn-info ml-auto">Add Row</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
