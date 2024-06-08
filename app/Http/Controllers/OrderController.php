<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:cash,midtrans',
        ]);

        $product = Product::find($request->product_id);
        $total_price = $product->price * $request->quantity;

        $order = Order::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
        ]);

        $transaction = Transaction::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'amount' => $total_price,
        ]);

        // Integrasi dengan Midtrans dilakukan di sini jika pembayaran via Midtrans

        return response()->json(['order' => $order, 'transaction' => $transaction]);
    }

    public function getOrders()
    {
        if (auth()->user()->role == 'owner') {
            return response()->json(Order::with('product', 'transaction')->get());
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
