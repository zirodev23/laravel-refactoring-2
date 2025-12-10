@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Products</h1>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">View Orders</a>
        </div>
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>${{ number_format($product->price, 2) }}</strong></p>
                            <form action="{{ route('orders.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="items[0][product_id]" value="{{ $product->id }}">
                                <input type="hidden" name="items[0][price]" value="{{ $product->price }}">
                                <div class="form-group mb-2">
                                    <label for="quantity_{{ $product->id }}">Quantity:</label>
                                    <input type="number" name="items[0][quantity]" id="quantity_{{ $product->id }}" value="1" min="1" class="form-control" style="width: 80px; display: inline;">
                                </div>
                                <button type="submit" class="btn btn-primary">Buy Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p>No products available.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection