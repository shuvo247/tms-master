<div class="modal fade" id="paymentPethodAddModal" tabindex="-1" role="dialog" aria-labelledby="paymentPethodAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paymentPethodAddModal">Add Payment Method</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('product.payment-method.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="methodName" class="col-form-label">Method Name</label>
              <input name="method_name" type="text" class="form-control" id="methodName" placeholder="Method Name">
            </div>
            <div class="form-group">
                <label for="description" class="col-form-label">Description</label>
                <textarea name="description" class="form-control" rows="10"></textarea>
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