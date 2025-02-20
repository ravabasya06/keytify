<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Review;

class ReviewListController extends Controller
{
    public function index(Request $request){ 
        $query = $request->input('search_query');

        if($query){
            $reviews = Review::where('name', 'LIKE', "%{$query}%")
            ->orWhere('desc', 'LIKE', "%{$query}%")
            ->select(['review_id', 'name', 'desc', 'image_url', 'rating'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }
        else {
            $reviews = Review::select(['review_id', 'name', 'desc', 'image_url', 'rating'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }

        return Inertia::render('ReviewList', [
            'reviews' => $reviews,
        ]);
    }

    public function filter($slug){
        $query = Review::select(['review_id', 'name', 'desc', 'image_url', 'rating']);

        if ($slug === 'alphabet-ascending') {
            $query->orderBy('name');
        } elseif ($slug === 'alphabet-descending') {
            $query->orderByDesc('name');
        }

        $reviews = $query->paginate(10)->withQueryString()->onEachSide(1);
        return Inertia::render('ReviewList', [
            'reviews' => $reviews,
            'slug' => $slug
        ]);
    }

}
