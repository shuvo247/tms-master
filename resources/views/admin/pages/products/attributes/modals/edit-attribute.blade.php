<div class="modal fade" id="attributeEditModal" tabindex="-1" role="dialog" aria-labelledby="attributeEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="attributeEditModal">Edit Attribute</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('product.attribute.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="attribute_id" id="hiddenAttributeId">
            <div class="form-group">
              <label for="attributeName" class="col-form-label">Product Attribute Name</label>
              <input name="attribute_name" id="attributeName" type="text" class="form-control" value="">
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