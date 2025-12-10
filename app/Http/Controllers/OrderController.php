<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // GET /orders/{id}
    public function show($id)
    {
        $order = Order::with('items.product')
                      ->where('id', $id)
                      ->firstOrFail();

        // Calculate totals based on stored values
        $subtotal = $order->items->sum(fn($item) => $item->quantity * $item->price);
        $tax      = $subtotal * 0.07;
        $total    = $subtotal + $tax;

        // Format response
        return view('orders.show', [
            'order'    => $order,
            'subtotal' => number_format($subtotal, 2),
            'tax'      => number_format($tax, 2),
            'total'    => number_format($total, 2),
        ]);
    }

    // POST /orders
    public function store(Request $request)
    {
        $data = $request->validate([
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ]);

        // Create order without user association
        $order = new Order();
        $order->status  = 'pending';
        $order->save();

        // Attach items
        foreach ($data['items'] as $itemData) {
            // Get the product to ensure we always have a valid price
            $product = \App\Models\Product::findOrFail($itemData['product_id']);

            $order->items()->create([
                'product_id' => $itemData['product_id'],
                'quantity'   => $itemData['quantity'],
                'price'      => $product->price,  // Use the product's current price
            ]);
        }

        // Recalculate totals (same logic as in show())
        $subtotal = $order->items->sum(fn($i) => $i->quantity * $i->price); // Use stored price
        $tax      = $subtotal * 0.07;
        $total    = $subtotal + $tax;
        $order->update(['subtotal' => $subtotal, 'tax' => $tax, 'total' => $total]);

        return redirect()->route('orders.show', $order);
    }
}
