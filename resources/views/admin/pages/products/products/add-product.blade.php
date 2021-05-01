@extends('admin.master')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Product</h4>
            <div class="repeater-default m-t-30">
                <div data-repeater-list="">
                    <div data-repeater-item="">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="name">Supplier</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="name">Category</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">Brand</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="pwd">Product Name</label>
                                    <input type="password" class="form-control" id="pwd" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="msg">Pcs Per Box</label>
                                    <textarea class="form-control" id="msg" rows="1" placeholder="Message"></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="name">Purchase Price</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">Sell Price</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="pwd">Product Type</label>
                                    <input type="password" class="form-control" id="pwd" placeholder="Password">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="msg">Quantity(sft)</label>
                                    <textarea class="form-control" id="msg" rows="1" placeholder="Message"></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="msg">Low Stock Quantity</label>
                                    <textarea class="form-control" id="msg" rows="1" placeholder="Message"></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="msg">Payment Method</label>
                                    <select name="" id="">
                                        <option value="">Bkash</option>
                                        <option value="">Bkash</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <button class="btn btn-success waves-effect waves-light" type="submit">Submit
                                    </button>
                                    <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light m-l-10" type="button">Delete Form
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection