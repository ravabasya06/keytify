<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\UserAddress;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;

class CheckoutController extends Controller
{
    public function index()
    {
        $session_id = Session::getId();
        $user_id = Auth::id();

        $user_address = UserAddress::where('user_id', $user_id)->first();
        $cart_items = Cart::with(['item:item_id,name,slug,stock,price,image_url'])
            ->whereIn('user_id', [$user_id, null])
            ->orWhere('session_id', $session_id)
            ->select(['cart_id', 'item_id', 'quantity'])
            ->get();

        return Inertia::render('Checkout', [
            'user_address' => $user_address,
            'cart_items' => $cart_items,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Fetch cart items
        $cartItems = Cart::with('item')
            ->where(function ($query) use ($user) {
                if ($user) {
                    $query->where('user_id', $user->id);
                } else {
                    $query->where('session_id', session()->getId());
                }
            })->get();

        if ($cartItems->isEmpty()) {
            return Redirect::back()->with('message', 'Your cart is empty.');
        }

        // Calculate total price
        $totalPrice = $cartItems->sum(fn($cart) => $cart->item->price * $cart->quantity);
        // Create order
        $order = Order::create([
            'user_id' => $user ? $user->id : null,
            'session_id' => $user ? null : Session::getId(),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Insert shipping address
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

        // Insert order items
        foreach ($cartItems as $cart) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'item_id' => $cart->item_id,
                'quantity' => $cart->quantity,
                'price' => $cart->item->price ?? 0,
            ]);
        }

        // Clear cart
        Cart::where('user_id', $user->id)->orWhere('session_id', Session::getId())->delete();

        return Redirect::route('home')->with('message', 'Order placed successfully!');
    }
}
