<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Order Products
                        <a href="#" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                            data-bs-target="#"><i class="fas fa-cart-plus me-2"></i>Add Orders</a>
                    </h4>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible mt-1">
                        @foreach ($errors->all() as $error)
                            <ul>
                                <li>{{ $error }}</li>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </ul>
                        @endforeach
                    </div>
                @endif
                {{-- <form action="{{ route('orders.store') }}" method="post">
                    @csrf --}}
                <div class="card-body">
                    <div class="my-2">
                        <form wire:submit.prevent="InsertoCart">
                            <input type="text" name="" wire:model="product_code" id=""
                                class="form-control" placeholder="Enter Product code">
                        </form>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif (session()->has('info'))
                        <div class="alert alert-info">{{ session('info') }}</div>
                    @elseif (session()->has('warning'))
                        <div class="alert alert-warning">{{ session('warning') }}</div>
                    @elseif (session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if ($message)
                        <div class="alert alert-success">{{ $message }}</div>
                    @else
                    @endif
                    <table class="table table-striped table-bordered table-hover table-start" id="">
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Qnty</th>
                                <th>Price</th>
                                <th>Dis (%)</th>
                                <th colspan="6">Total</th>
                                {{-- <th width="1%"><a href="#" class="btn btn-sm btn-success add_more"><i
                                            class="fas fa-plus-circle"></i></a></th> --}}
                            </tr>
                        </thead>
                        <tbody class="addMoreProduct">
                            @foreach ($productIncart as $key => $cart)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <input type="text" value="{{ $cart->product->product_name }}"
                                            class="form-control">
                                    </td>
                                    <td width="15%">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button wire:click.prevent="IncrementQty({{ $cart->id }})"
                                                    class="btn btn-sm btn-success"> + </button>
                                            </div>
                                            <div class="col-md-1">
                                                <label for="">&nbsp;&nbsp;{{ $cart->product_qty }}</label>
                                            </div>
                                            <div class="col-md-2">
                                                <button wire:click.prevent="DecrementQty({{ $cart->id }})"
                                                    class="btn btn-sm btn-danger"> - </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control price"
                                            value="{{ $cart->product->price }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control discount">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control total_amount"
                                            value="{{ $cart->product_qty * $cart->product->price }}">
                                    </td>
                                    <td class="text-center"><a href="#" class="btn btn-sm btn-danger"><i
                                                class="fas fa-times"
                                                wire:click="removeProduct({{ $cart->id }})"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Total <b class="total">{{ $productIncart->sum('product_price') }}</b> TAKA</h4>
                </div>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    @foreach ($productIncart as $key => $cart)
                        <input type="hidden" name="product_id[]" value="{{ $cart->product->id }}" id=""
                            class="form-control">
                        <input type="hidden" name="quantity[]" value="{{ $cart->product_qty }}">
                        <input type="hidden" class="form-control price" value="{{ $cart->product->price }}"
                            name="price[]">
                        <input type="hidden" class="form-control discount" name="discount[]" id="discount">
                        <input type="hidden" class="form-control total_amount"
                            value="{{ $cart->product_qty * $cart->product->price }}" name="total_amount[]"
                            id="total_amount">
                    @endforeach

                    <div class="card-body">
                        <div class="btn-group mb-2">
                            <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-dark me-2"><i
                                    class="fas fa-print me-1"></i> Print</button>
                            <button type="button" onclick="PrintReceiptContent('print')"
                                class="btn btn-primary me-2"><i class="fas fa-print me-1"></i> History</button>
                            <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-info me-2"><i
                                    class="fas fa-print me-1"></i> Report</button>
                        </div>
                        <div class="panel">
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="">Customer Name <b
                                                        class="text-danger">*</b></label>
                                                <input type="text" class="form-control" name="customer_name">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="">Phone<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control" name="phone">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <td>
                                    Payment Method <br>
                                    <div class="d-flex">
                                        <span class="radio-item me-3">
                                            <input type="radio" class="true" name="payment_method"
                                                id="payment_method" value="Cash" checked="checked" />
                                            <label for=""><i
                                                    class="fas fa-money-bill text-success me-1"></i>Cash</label>
                                        </span>
                                        <span class="radio-item me-3">
                                            <input type="radio" class="true" name="payment_method"
                                                id="payment_method" value="Bkash" />
                                            <label for=""><i
                                                    class="far fa-credit-card text-danger me-1"></i>Bkash</label>
                                        </span>
                                        <span class="radio-item me-3">
                                            <input type="radio" class="true" name="payment_method"
                                                id="payment_method" value="DBBL" />
                                            <label for=""><i
                                                    class="fas fa-credit-card text-default me-1"></i>DBBL</label>
                                        </span>
                                    </div>
                                </td>
                                <p></p>
                                <td>
                                    Payment
                                    <input type="text" wire:model="pay_money" name="paid_amount" id="paid_amount"
                                        class="form-control">
                                </td>
                                <td>
                                    Returning Change
                                    <input type="text" wire:model="balance" name="balance" id="balance"
                                        class="form-control" readonly>
                                </td>
                                <td>
                                    <button class="btn btn-md btn-primary mt-4" type="submit">Save</button>
                                </td>
                                <td>
                                    <button class="btn btn-md btn-danger mt-2" type="submit">Calculator</button>
                                </td>
                                <div class="text-center mt-1">
                                    <a href="#" class="text-danger text-decoration-none"><i
                                            class="fas fa-sign-out-alt me-1"></i>Logout</a>
                                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
{{-- </form> --}}
</div>
</div>
