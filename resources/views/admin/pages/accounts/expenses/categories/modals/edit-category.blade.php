<div class="modal fade" id="expenseCategoryEditModal" tabindex="-1" role="dialog" aria-labelledby="expenseCategoryEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="expenseCategoryEditModal">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('account.expenses.category.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="expense_category_id" id="hiddenExpenseCategoryId">
            <div class="form-group">
              <label for="expenseCategoryName" class="col-form-label">Category Name</label>
              <input name="expense_category_name" id="expenseCategoryName" type="text" class="form-control" value="">
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