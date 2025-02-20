<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $session_id = Session::getId();
        $user_id = Auth::id();
        $cart_items = Cart::with(['item:item_id,name,slug,slug,stock,price,image_url'])
            ->where('user_id', $user_id)
            ->orWhere('session_id', $session_id)
            ->select(['cart_id', 'item_id', 'quantity'])
            ->get();
        $total_price = $cart_items->sum(function ($cart) {
            return $cart->item->price * $cart->quantity;
        });

        return Inertia::render('Cart', [
            'cart_items' => $cart_items,
            'total_price' => $total_price
        ]);
    }

    public function store(Request $request, $id) // Add $id here
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
    
        $session_id = Session::getId();
        $user_id = Auth::id();
    
        // Check if the item is already in the cart
        $cart = Cart::where(function ($query) use ($user_id, $session_id, $id) {
            $query->where('item_id', $id)
                ->where(function ($query) use ($user_id, $session_id) {
                    if ($user_id) {
                        $query->where('user_id', $user_id);
                    } else {
                        $query->where('session_id', $session_id);
                    }
                });
        })->first();
    
        if ($cart) {
            $cart->update(['quantity' => $cart->quantity + $validated['quantity']]);
        } else {
            Cart::create([
                'user_id' => $user_id,
                'session_id' => $user_id ? null : $session_id,
                'item_id' => $id, // Use $id instead of validated['item_id']
                'quantity' => $validated['quantity']
            ]);
        }
    
        return Redirect::back()->with('message', 'An item successfully added to cart!');
    }    

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->update($validated);
    
        return Redirect::back()->with('message', 'Cart updated successfully');
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return Redirect::back()->with('message', 'An item successfully deleted from cart');
    }
}
