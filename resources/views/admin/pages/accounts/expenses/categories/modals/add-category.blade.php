<div class="modal fade" id="expenseCategoryAddModal" tabindex="-1" role="dialog" aria-labelledby="expenseCategoryAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="expenseCategoryAddModal">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('account.expenses.category.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="expenseCategoryName" class="col-form-label">Expense Category Name</label>
              <input name="expense_category_name" type="text" class="form-control" id="expenseCategoryName" placeholder="Expense Category Name">
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