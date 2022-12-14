@extends('layouts.app')
@section('title', 'Products Barcode')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Products Barcode
                            </h4>
                        </div>
                        <div class="card-body">
                            <div id="print">
                                <div class="row">
                                    @forelse ($productsBarcode as $barcode)
                                        <div class="col-lg-3 col-md-4 col-sm-12 mt-3 text-center w-auto">
                                            <div class="card" >
                                                <div class="card-body">
                                                    <img src="{{ asset('image/products/barcodes/' . $barcode->barcode) }}" alt="">
                                                    <h4 class="text-center" style="padding: 0.5em; margin-top: 0.5em">{{ $barcode->product_code}}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h2 class="text-center">No Data</h2>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
