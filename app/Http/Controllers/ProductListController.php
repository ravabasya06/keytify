<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Item;

class ProductListController extends Controller
{
    public function index(){
        $items = Item::with(['category:category_id,name', 'brand:brand_id,name'])
        ->select(['item_id', 'name', 'slug', 'category_id', 'brand_id', 'type', 'stock', 'price', 'short_desc', 'desc', 'image_url', 'status'])
        ->paginate(10)->withQueryString()->onEachSide(1);
        // dd($items);
        return Inertia::render('ProductList', [
            'items' => $items,
        ]);
    }
}
