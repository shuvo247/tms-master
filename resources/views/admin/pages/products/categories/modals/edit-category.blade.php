<div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog" aria-labelledby="categoryEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="categoryEditModal">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('product.category.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category_id" id="hiddenCategoryId">
            <div class="form-group">
              <label for="categoryName" class="col-form-label">Product Category Name <span class="text-danger">*</span></label>
              <input name="category_name" id="categoryName" type="text" class="form-control" value="">
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