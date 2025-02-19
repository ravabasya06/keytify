<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use Inertia\Inertia;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;

class ShopController extends Controller
{
    public function index(Request $request){
        $query = $request->input('search_query');
        $categories = Category::leftJoin('items', 'items.category_id', '=', 'categories.category_id')
        ->select('categories.category_id', 'categories.name', 'categories.slug', DB::raw('COUNT(items.item_id) as count'))
        ->groupBy('categories.category_id', 'categories.name', 'categories.slug')
        ->get();

        if($query){
            $all_items = Item::join('categories', 'items.category_id', '=', 'categories.category_id')->leftJoin('brands', 'items.brand_id', '=', 'brands.brand_id');
            
            $results = $all_items->where('items.name', 'LIKE', "%{$query}%")
            ->orWhere('items.type', 'LIKE', "%{$query}%")
            ->orWhere('items.short_desc', 'LIKE', "%{$query}%")
            ->orWhere('items.desc', 'LIKE', "%{$query}%")
            ->orWhere('brands.name', 'LIKE', "%{$query}%")
            ->orWhere('categories.name', 'LIKE', "%{$query}%")
            ->select('items.name', 'items.slug', 'items.price', 'items.short_desc', 'items.image_url');
        }
        else {
            $results = Item::select('name', 'slug', 'price', 'short_desc', 'image_url');
        }
        
        $items = $results->paginate(12)->withQueryString()->onEachSide(1);
        $total = $items->total();
        return Inertia::render('Shop', [
            'items' => $items,
            'total' => $total,
            'current_query' => $query,
            'categories' => $categories,
            'category_title' => "Shop"
        ]);
    }

    public function filter($slug){
        $categories = Category::leftJoin('items', 'items.category_id', '=', 'categories.category_id')
        ->select('categories.category_id', 'categories.name', 'categories.slug', DB::raw('COUNT(items.item_id) as count'))
        ->groupBy('categories.category_id', 'categories.name', 'categories.slug')
        ->get();

        if($slug == "featured"){
            $results = Item::where('featured', true)
            ->select('name', 'slug', 'price', 'short_desc', 'image_url');
        }
        else if($slug == "price-ascending"){
            $category_title = "Price Ascending";
            $results = Item::select('name', 'slug', 'price', 'short_desc', 'image_url')
            ->orderBy('price');
        }
        else if($slug == "price-descending"){
            $category_title = "Price Descending";
            $results = Item::select('name', 'slug', 'price', 'short_desc', 'image_url')
            ->orderByDesc('price');
        }
        else {
            $title = Category::where('slug', $slug)
            ->select('name')
            ->union(
                Brand::where('slug', $slug)
                    ->select('name')
            )
            ->first();

            $results = Item::join('categories', 'items.category_id', '=', 'categories.category_id')
            ->leftJoin('brands', 'items.brand_id', '=', 'brands.brand_id')
            ->where('brands.slug', $slug)
            ->orWhere('categories.slug', $slug)
            ->select('items.name', 'items.slug', 'items.price', 'items.short_desc', 'items.image_url');
        }

        $items = $results->paginate(12)->withQueryString()->onEachSide(1);
        $total = $items->total();
        return Inertia::render('Shop', [
            'items' => $items,
            'total' => $total,
            'categories' => $categories,
            'category_title' => $title['name'] ?? $category_title ?? "Featured"
        ]);
    }
}
