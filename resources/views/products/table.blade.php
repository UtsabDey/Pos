<table class="table table-striped table-bordered table-hover table-start" id="dataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Brand Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Alert Stock</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $no++ }}</td>
                <td wire:click="ProductDetails({{ $product->id }})" data-bs-toggle="tooltip" data-bs-placement="right" title="Click to view Details"><a href="#" class="text-decoration-none">{{ $product->product_name }}</a></td>
                <td>{{ $product->brand }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->quantity }}</td>
                <td class="text-center">
                    @if ($product->alert_stock >= $product->quantity)
                        <span class="badge bg-danger">Low Stock</span>
                    @else
                        <span class="badge bg-success">{{ $product->alert_stock }}</span>
                    @endif
                </td>
                <td class="text-center">
                    <div class="btn-group">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#editProduct{{ $product->id }}"
                            class="btn  btn-sm btn-info me-2"><i class="fas fa-edit me-1"></i>Edit</a>
                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteProduct{{ $product->id }}"><i
                                class="fas fa-trash me-1"></i>Delete</a>
                    </div>
                </td>
            </tr>
            @include('products.editmodal')
            @include('products.deletemodal')
        @empty
        @endforelse
    </tbody>
</table>
