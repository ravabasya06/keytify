<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Item;

class ItemController extends Controller
{
    public function index($slug){
        $item = Item::where('slug', $slug)
        ->with(['category:category_id,name,slug', 'brand:brand_id,name,slug'])
        ->select(['item_id', 'name', 'slug', 'category_id', 'brand_id', 'type', 'stock', 'price', 'short_desc', 'desc', 'image_url', 'status', 'featured'])
        ->first();

        $related_items = Item::where('item_id', '!=', $item['item_id'])->where('category_id', $item['category_id'])->orWhere('brand_id', $item['brand_id'])->inRandomOrder()->limit(3)->select(['name', 'slug', 'price', 'short_desc', 'image_url'])->get();
        return Inertia::render('ItemDetails', [
            'item' => $item,
            'related_items' => $related_items,
        ]);
    }
}
