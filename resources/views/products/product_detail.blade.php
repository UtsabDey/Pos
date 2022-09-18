<div class="row">
    @forelse ($products_details as $product)
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Pro ID</label>
                <img data-bs-toggle="modal" data-bs-target="#productPreview{{ $product->id }}"
                    src="{{ asset('image/products/' . $product->product_image) }}" width="70" style="cursor: pointer;"
                    alt="">
                <input type="text" class="form-control" value="{{ $product->id }}" readonly>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Pro Name</label>
                <input type="text" class="form-control" value="{{ $product->product_name }}" readonly>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Pro Code</label>
                <input type="text" class="form-control" value="{{ $product->product_code }}" readonly>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Pro Price</label>
                <input type="text" class="form-control" value="{{ $product->price }}" readonly>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Pro Qty</label>
                <input type="text" class="form-control" value="{{ $product->quantity }}" readonly>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Pro Stock</label>
                <input type="text" class="form-control" value="{{ $product->alert_stock }}" readonly>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Pro Description</label>
                <textarea class="form-control" cols="10" rows="2">{{ $product->description }}</textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group" style="text-align: center !important; padding-left:8%">
                <span style="text-align: center">
                    <img src="{{ asset('image/products/barcodes/' . $product->barcode) }}" width="70"
                        style="cursor: pointer;" alt="">
                </span>
                <h5>{{ $product->product_code }}</h5>
            </div>
        </div>
        @include('products.product_preview')
    @empty

    @endforelse
</div>

<style>
    input:read-only {
        background: #fff !important;
    }

    textarea:read-only {
        background: #fff !important;
    }
</style>
