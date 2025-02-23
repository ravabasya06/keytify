<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;

class OrderDetailsController extends Controller
{
    public function index()
    {
        return Inertia::render('OrderSearch', [
        ]);
    }

    public function details($id)
    {
        $order = Order::where('invoice_id', $id)->first();
        $order_items = OrderItem::with('item:item_id,name,slug,price')->where('order_id', $order->order_id)->get();
        $order_address = OrderAddress::where('order_id', $order->order_id)->first();
        return Inertia::render('OrderDetails', [
            'order' => $order,
            'items' => $order_items,
            'address' => $order_address,
        ]);
    }

    public function success(Request $request){
        $order = Order::where('invoice_id', $request->id)->first();

        $order->status = 'processed';
        $order->save();

        return Redirect::back()->with('message', 'Payment success! Processing your package now!');
    }

    public function failed(){
        return Redirect::back()->with('message', 'Payment failed, please try again later.');
    }
}
