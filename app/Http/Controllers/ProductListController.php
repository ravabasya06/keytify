<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;

class ProductListController extends Controller
{
    public function index(Request $request){ 
        $query = $request->input('search_query');

        $brands = Brand::get();
        $categories = Category::leftJoin('items', 'items.category_id', '=', 'categories.category_id')
        ->select('categories.category_id', 'categories.name', 'categories.slug', DB::raw('COUNT(items.item_id) as count'))
        ->groupBy('categories.category_id', 'categories.name', 'categories.slug')
        ->get();

        if($query){
            $all_items = Item::with(['category:category_id,name', 'brand:brand_id,name']);
            $items = $all_items->where('name', 'LIKE', "%{$query}%")
            ->orWhere('type', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->select(['item_id', 'name', 'slug', 'category_id', 'brand_id', 'type', 'stock', 'price', 'featured', 'short_desc', 'desc', 'image_url', 'status'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }
        else {
            $items = Item::with(['category:category_id,name', 'brand:brand_id,name'])
            ->select(['item_id', 'name', 'slug', 'category_id', 'brand_id', 'type', 'stock', 'price', 'featured', 'short_desc', 'desc', 'image_url', 'status'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }

        return Inertia::render('ProductList', [
            'items' => $items,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    public function filter($slug){
        $brands = Brand::get();

        $categories = Category::leftJoin('items', 'items.category_id', '=', 'categories.category_id')
        ->select('categories.category_id', 'categories.name', 'categories.slug', DB::raw('COUNT(items.item_id) as count'))
        ->groupBy('categories.category_id', 'categories.name', 'categories.slug')
        ->get();

        $query = Item::with(['category:category_id,name', 'brand:brand_id,name'])
            ->select(['item_id', 'name', 'slug', 'category_id', 'brand_id', 'type', 'stock', 'price', 'featured', 'short_desc', 'desc', 'image_url', 'status']);

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
            'slug' => $slug,
            'brands' => $brands
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:items,name',
            'slug' => 'required|string|max:255|unique:items,slug',
            'category_id' => 'required',
            'brand_id' => 'nullable',
            'type' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'short_desc' => 'required|string',
            'desc' => 'nullable|string',
            'image_url' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
        ]);

        Item::create($validatedData);

        return Redirect::route('productlist.search')->with('message', 'New item has been successfully added');
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:items,name,' . $id . ',item_id',
            'slug' => 'required|string|max:255|unique:items,slug,' . $id . ',item_id',
            'category_id' => 'required',
            'brand_id' => 'nullable',
            'type' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'short_desc' => 'required|string',
            'desc' => 'nullable|string',
            'image_url' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
        ]);

        $item->update($validatedData);

        return Redirect::route('productlist.search')->with('message', 'An item has been successfully updated');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return Redirect::route('productlist.search')->with('message', 'An item has been successfully deleted');
    }
}
