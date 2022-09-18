<!-- Modal Add New User -->
<div class="modal fade" id="productPreview{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addUserLabel">{{ $product->product_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <img src="{{ asset('image/products/' . $product->product_image) }}" width="280" height="200"
                        style="cursor: pointer;" alt="">
                </div>
                <img src="{{ asset('image/products/barcodes/' . $product->barcode) }}" width="200"
                    style="cursor: pointer;" alt="">
            </div>
        </div>
    </div>
</div>
