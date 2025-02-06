<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Item;

class BrandController extends Controller
{
    public function index($slug){
        $brand = Brand::where('slug', $slug)
        ->select(['brand_id', 'name', 'slug', 'desc', 'image_url'])
        ->first();

        $recommended_items = Item::where('brand_id', $brand["brand_id"])->where('featured', true)->inRandomOrder()->limit(5)->select(['name', 'slug', 'price', 'short_desc', 'image_url'])->get();

        $items = Item::where('brand_id', $brand["brand_id"])->inRandomOrder()->limit(5)->select(['name', 'slug', 'price', 'short_desc', 'image_url'])->get();
        return Inertia::render('BrandDetails', [
            'brand' => $brand,
            'recommended_items' => $recommended_items,
            'items' => $items
        ]);
    }
}
