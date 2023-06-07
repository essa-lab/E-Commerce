<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        // Retrieve the order data from the request
        $orderData = $request->all();

        // Create a new order
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'order_number' => $this->generateUniqueOrderNumber(),
            'total_amount' => $this->calculateTotalPrice($orderData),
            'shipping_address'=>$request->ship
        ]);

        // // Store the ordered products in the order_items table
        // foreach ($orderData['items'] as $productData) {
        //     $product = Product::findOrFail($productData->id);
        //     $order->products()->attach($product, ['quantity' => $productData->quantity,'price'=>$productData->price]);
        // }

        // // Return a response indicating the successful order creation
        return response()->json($order);
    }
    function generateUniqueOrderNumber()
{
    return uniqid(); // Example: Generate a unique ID as the order number
}
function calculateTotalPrice(array $orderData)
{
    $total = 0;

    foreach ($orderData['items'] as $item) {
        $total += $item['price']*$item['quantity'];
    }

    return $total;
}
}
