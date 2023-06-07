<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        return response()->json($orders);
    }

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

        foreach ($orderData['items'] as $productData) {
            $product = Product::findOrFail($productData['id']);
            $order->products()->attach($product, [
                'quantity' => $productData['quantity'],
            'price'=>$productData['price'],
        ]);
        }

        return response()->json($order);
    }
    function generateUniqueOrderNumber(){
         $timestamp = time();
         $randomNumber = mt_rand(1000, 9999);

         return $timestamp . $randomNumber;
    }
    function calculateTotalPrice(array $orderData){
        $total = 0;

         foreach ($orderData['items'] as $item) {
             $total += $item['price']*$item['quantity'];
         }

        return $total;
    }
}
