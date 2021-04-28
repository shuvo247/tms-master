<div class="modal fade" id="brandEditModal" tabindex="-1" role="dialog" aria-labelledby="brandEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="brandEditModal">Edit Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('product.brand.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="brand_id" id="hiddenBrandId">
            <div class="form-group">
              <label for="brandName" class="col-form-label">Product Brand Name</label>
              <input name="brand_name" id="brandName" type="text" class="form-control" value="">
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