<div class="modal fade" id="supplierTypeAddModal" tabindex="-1" role="dialog" aria-labelledby="supplierTypeAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="supplierTypeAddModal">Add Supplier Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('register.supplier.supplier-type.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="supplierType" class="col-form-label">Supplier Type <span class="text-danger">*</span></label>
              <input name="supplier_type" type="text" class="form-control" id="supplierType" placeholder="Ex : Dealer, Retailer, Manufacturer, Flying Purchase">
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