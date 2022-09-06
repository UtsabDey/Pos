@extends('layouts.app')
@section('title', 'Products')
@section('content')
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
                                            <td>{{ $product->product_name }}</td>
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
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editProduct{{ $product->id }}"
                                                        class="btn  btn-sm btn-info me-2"><i
                                                            class="fas fa-edit me-1"></i>Edit</a>
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
                            {{-- {{ $users->links() }} --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Search Product</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('products.addmodal')
@endsection
