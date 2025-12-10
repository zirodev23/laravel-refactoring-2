@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Order #{{ $order->id }}</h1>
        
        <div class="card mb-4">
            <div class="card-header">
                <h5>Order Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Status:</strong> <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'secondary') }}">{{ ucfirst($order->status) }}</span></p>
                <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <h5>Order Items</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <table class="table">
                            <tr>
                                <td><strong>Subtotal:</strong></td>
                                <td>${{ $order->subtotal }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tax:</strong></td>
                                <td>${{ $order->tax }}</td>
                            </tr>
                            <tr>
                                <td><strong>Total:</strong></td>
                                <td><strong>${{ $order->total }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection