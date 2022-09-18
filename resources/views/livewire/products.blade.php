<div>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Products List
                                <a href="#" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#addProduct"><i class="fas fa-cart-plus me-2"></i>Add Products</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('products.table')
                            {{-- {{ $users->links() }} --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product Details</h4>
                        </div>
                        <div class="card-body">
                            @include('products.product_detail')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
