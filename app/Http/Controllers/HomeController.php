<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Item;
use App\Models\Review;

class HomeController extends Controller
{
    public function index(){
        $featured_items = Item::where('featured', 1)->orderBy('created_at')->inRandomOrder()->limit(4)->select(['name', 'slug', 'price', 'short_desc', 'image_url'])->get();
        $reviews = Review::orderBy('created_at')->get();
        return Inertia::render('Home', [
            'featured_items' => $featured_items,
            'reviews' => $reviews,
        ]);
    }
}
