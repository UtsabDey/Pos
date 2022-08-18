<!-- Modal Add New User -->
<div class="modal fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addUserLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    aria-describedby="" placeholder="Product Name" required>
                                @error('product_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" id="brand" name="brand"
                                    aria-describedby="" placeholder="Brand Name" required>
                                @error('brand')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="" class="form-label">Sale Price (BDT)</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        aria-describedby="" placeholder="500.00">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="stock" name="quantity"
                                        placeholder="Quantity" required>
                                    @error('quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Alert Stock</label>
                                <input type="number" class="form-control" id="alert_stock" name="alert_stock" value="100"
                                    placeholder="Alert Stock">
                                @error('alert_stock')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Description"></textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

