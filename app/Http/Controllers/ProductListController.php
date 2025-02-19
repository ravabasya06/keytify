<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;

class ProductListController extends Controller
{
    public function index(Request $request){ 
        $query = $request->input('search_query');

        $categories = Category::leftJoin('items', 'items.category_id', '=', 'categories.category_id')
        ->select('categories.category_id', 'categories.name', 'categories.slug', DB::raw('COUNT(items.item_id) as count'))
        ->groupBy('categories.category_id', 'categories.name', 'categories.slug')
        ->get();

        if($query){
            $all_items = Item::with(['category:category_id,name', 'brand:brand_id,name']);
            $items = $all_items->where('name', 'LIKE', "%{$query}%")
            ->orWhere('type', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->select(['item_id', 'name', 'slug', 'category_id', 'brand_id', 'type', 'stock', 'price', 'short_desc', 'desc', 'image_url', 'status'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }
        else {
            $items = Item::with(['category:category_id,name', 'brand:brand_id,name'])
            ->select(['item_id', 'name', 'slug', 'category_id', 'brand_id', 'type', 'stock', 'price', 'short_desc', 'desc', 'image_url', 'status'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }

        return Inertia::render('ProductList', [
            'items' => $items,
            'categories' => $categories
        ]);
    }

    public function filter($slug){
        $categories = Category::leftJoin('items', 'items.category_id', '=', 'categories.category_id')
        ->select('categories.category_id', 'categories.name', 'categories.slug', DB::raw('COUNT(items.item_id) as count'))
        ->groupBy('categories.category_id', 'categories.name', 'categories.slug')
        ->get();

        if($slug == "featured"){
            $items = Item::where('featured', true)
            ->select('name', 'slug', 'price', 'short_desc', 'image_url')
            ->get();
        }
        else {
            $title = Category::where('slug', $slug)
            ->select('name')
            ->union(
                Brand::where('slug', $slug)
                    ->select('name')
            )
            ->first();

            $items = Item::join('categories', 'items.category_id', '=', 'categories.category_id')
            ->leftJoin('brands', 'items.brand_id', '=', 'brands.brand_id')
            ->where('brands.slug', $slug)
            ->orWhere('categories.slug', $slug)
            ->select('items.name', 'items.slug', 'items.price', 'items.short_desc', 'items.image_url')
            ->get();

        }

        return Inertia::render('Shop', [
            'items' => $items,
            'categories' => $categories,
            'category_title' => $title['name'] ?? "Featured"
        ]);
    }

}
