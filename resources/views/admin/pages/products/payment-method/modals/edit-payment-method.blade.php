<div class="modal fade" id="paymentMethodEditModal" tabindex="-1" role="dialog" aria-labelledby="paymentMethodEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paymentMethodEditModal">Edit Payment Method</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('product.payment-method.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="payment_method_id" id="hiddenPaymentMethodId">
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