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

        $query = Item::with(['category:category_id,name', 'brand:brand_id,name'])
            ->select(['item_id', 'name', 'slug', 'category_id', 'brand_id', 'type', 'stock', 'price', 'short_desc', 'desc', 'image_url', 'status']);

        if ($slug === 'price-ascending') {
            $query->orderBy('price');
        } elseif ($slug === 'price-descending') {
            $query->orderByDesc('price');
        } elseif ($slug) {
            $query->whereRelation('category', 'slug', $slug);
        }

        $items = $query->paginate(10)->withQueryString()->onEachSide(1);
        return Inertia::render('ProductList', [
            'items' => $items,
            'categories' => $categories,
            'slug' => $slug
        ]);
    }

}
