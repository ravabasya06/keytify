<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\UserAddress;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;

class CheckoutController extends Controller
{
    public function index()
    {
        $sessionId = Session::getId();
        $userId = Auth::id();

        $userAddress = UserAddress::where('user_id', $userId)->first();

        $cartItems = Cart::with('item:item_id,name,slug,stock,price,image_url')
            ->where('session_id', $sessionId)
            ->orWhere('user_id', $userId)
            ->get();

        return Inertia::render('Checkout', [
            'user_address' => $userAddress,
            'cart_items' => $cartItems,
        ]);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $sessionId = Session::getId();

        $cartItems = Cart::with('item')
            ->where('session_id', $sessionId)
            ->orWhere('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return Redirect::back()->with('message', 'Your cart is empty.');
        }

        $totalPrice = 0;
        foreach ($cartItems as $cart) {
            $totalPrice += $cart->item->price * $cart->quantity;
        }

        $order = Order::create([
            'user_id' => $userId,
            'session_id' => $userId ? null : $sessionId,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        OrderAddress::create([
            'order_id' => $order->order_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'island' => $request->island,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
        ]);

        foreach ($cartItems as $cart) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'item_id' => $cart->item_id,
                'quantity' => $cart->quantity,
                'price' => $cart->item->price,
            ]);
        }

        Cart::where('user_id', $userId)->orWhere('session_id', $sessionId)->delete();

        return Redirect::route('home')->with('message', 'Order placed successfully!');
    }
}
