@extends('layouts.app')
@section('title', 'Orders')
@section('content')
    <div class="container">
        @livewire('order')
    </div>

    

    <div class="modal">
        <div id="print">
            @include('reports.receipt')
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.add_more').on('click', function() {
            var product = $('.product_id').html();
            var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
            var tr = '<tr><td>' + numberofrow + '</td>' +
                '<td><select class="form-control product_id form-select" name="product_id[]">' + product +
                '</select></td>' +
                '<td><input type="text" class="form-control quantity" name="quantity[]"></td>' +
                '<td><input type="text" class="form-control price" name="price[]"></td>' +
                '<td><input type="text" class="form-control discount" name="discount[]"></td>' +
                '<td><input type="text" class="form-control total_amount" name="total_amount[]"></td>' +
                '<td class="text-center"><a class="btn btn-sm delete btn-danger"><i class="fas fa-times"></i></a></td></tr>';
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

        $('.addMoreProduct').delegate('.product_id', 'change', function() {
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

        $('.addMoreProduct').delegate('.quantity , .discount', 'keyup', function() {
            var tr = $(this).parent().parent();
            var quantity = tr.find('.quantity').val() - 0;
            var discount = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;
            var total_amount = (quantity * price) - ((quantity * price * discount) / 100);
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });

        $('#paid_amount').keyup(function() {
            var total = $('.total').html();
            var paid_amount = $(this).val();
            var total_amount = paid_amount - total;
            $('#balance').val(total_amount);
            // $('#balance').val(total_amount).toFixed(2);
        });
    </script>
    <script>
        function PrintReceiptContent(el) {
            var data = '<input type="button" id="PrintPageButton" class="PrintPageButton" style="display:block; width:100%; border:none; border-radius:5px; background-color:#008B8B; color:#fff; padding:14px 28px; font-size:16px; cursor:pointer; text-align:center;" value="Print Receipt" onclick="window.print()" ><br> ';
                data += document.getElementById(el).innerHTML;
                myReceipt = window.open("", "myWin", "left=350, top=130, width=400, height=470");
                    myReceipt.screnX = 0;
                    myReceipt.screnY = 0;
                    myReceipt.document.write(data);
                    myReceipt.document.title = "Print Receipt";
                myReceipt.focus();
                setTimeout(() => {
                    myReceipt.close();
                }, 5000);
        }
    </script>
@endsection
