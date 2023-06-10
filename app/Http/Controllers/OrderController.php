<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class OrderController extends ApiController
{
    public function getOrders()
    {
        try{
            $user = Auth::user();
            if(!$user){
                throw new \Exception();
            }
            $orders = Order::where('user_id', $user->id)->get();
            return $this->sendResponse($orders,"Order retireved!",Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->sendErrorResponse("Error retriving Orders",$e->getMessage(),Response::HTTP_NOT_FOUND);
        }
    }
    public function index(){
        try{

            $order = Order::all();
            return  $this->sendResponse($order,'Order retrived',Response::HTTP_OK);

            }catch(\Exception $e){

                return $this->sendErrorResponse('Error in retriving Order',$e->getMessage(),Response::HTTP_NOT_FOUND);

            }
    }
    public function store(Request $request)
    {

        // Retrieve the order data from the request
        $orderData = $request->all();

        $validator = Validator::make($orderData, [
            'user_id'=>'required',
            'shipping_address'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse("Validation Error",$validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try{
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

        return $this->sendResponse($order,'Order Created!',Response::HTTP_OK);
    }catch(\Exception $e){
        return $this->sendErrorResponse('Error creating Order',$e->getMessage(),Response::HTTP_NOT_FOUND);
    }
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
    public function getOrderDetails($orderId){
        try{
        $order = Order::with('products')->findOrFail($orderId);

        return $this->sendResponse($order,"Order retireved!",Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->sendErrorResponse("Error retriving Order!",$e->getMessage(),Response::HTTP_NOT_FOUND);
        }
    }
}
