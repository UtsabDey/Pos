@extends('layouts.app')
@section('title', 'Products')
@section('content')

    @livewire('products')
    @include('products.addmodal')
    
@endsection
