@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Welcome to Our E-commerce Store</h1>
                <p class="card-text">Browse our products and create orders.</p>
                <div class="mt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-primary me-2">View Products</a>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">View Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection