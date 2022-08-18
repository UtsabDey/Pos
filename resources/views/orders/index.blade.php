@extends('layouts.app')
@section('title', 'Orders')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Ordered Products
                                <a href="#" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#addProduct"><i class="fas fa-cart-plus me-2"></i>Add Orders</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover table-start" id="dataTable2">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th width="4%">Product Name</th>
                                        <th width="2%">Quantity</th>
                                        <th width="2%">Price</th>
                                        <th width="2%">Discount (%)</th>
                                        <th width="2%">Total</th>
                                        <th width="1%"><a href="#" class="btn btn-sm btn-success add_more"><i
                                                    class="fas fa-plus-circle"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody class="addMoreProduct">
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select name="product_id" id="product_id" class="form-select product_id">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option data-price="{{ $product->price }}" value="{{ $product->id }}">{{ $product->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control quantity" name="quantity[]" id="quantity">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control price" name="price[]" id="price">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control discount" name="discount[]" id="discount">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control total_amount" name="total_amount[]"
                                                id="total_amount">
                                        </td>
                                        <td><a href="#" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Total <b class="total">0.00</b> TAKA</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.add_more').on('click', function() {
            var product = $('.product_id').html();
            var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
            var tr = '<tr><td>' + numberofrow + '</td>' +
                '<td><select class="form-control product_id" name="product_id[]">' + product + '</select></td>' +
                '<td><input type="number" class="form-control quantity" name="quantity[]"></td>' +
                '<td><input type="number" class="form-control price" name="price[]"></td>' +
                '<td><input type="number" class="form-control discount" name="discount[]"></td>' +
                '<td><input type="number" class="form-control total_amount" name="total_amount[]"></td>' +
                '<td><a class="btn btn-sm delete btn-danger"><i class="fas fa-times"></i></a></td></tr>';
            $('.addMoreProduct').append(tr);
        });

        $('.addMoreProduct').delegate('.delete', 'click', function() {
            $(this).parent().parent().remove();
        });

        function TotalAmount() {
            var total = 0;
            $('.total_amount').each(function(i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });

            $('.total').html(total);
        }

        $('.addMoreProduct').delegate('.product_id', 'change', function(){
            var tr = $(this).parent().parent();
            var price = tr.find('.product_id option:selected').attr('data-price');
            tr.find('.price').val(price);
            var quantity = tr.find('.quantity').val() - 0;
            var discount = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;
            var total_amount = (quantity * price) - ((quantity * price * discount) / 100);
            tr.find('.total_amount').val(total_amount); 
            TotalAmount();
        });

        $('.addMoreProduct').delegate('.quantity , .discount', 'keyup', function(){
            var tr = $(this).parent().parent();
            var quantity = tr.find('.quantity').val() - 0;
            var discount = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;
            var total_amount = (quantity * price) - ((quantity * price * discount) / 100);
            tr.find('.total_amount').val(total_amount); 
            TotalAmount();
        }); 
    </script>
@endsection
