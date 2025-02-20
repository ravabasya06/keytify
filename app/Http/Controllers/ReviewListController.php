<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'desc' => 'nullable|string',
            'image_url' => 'nullable|string',
            'rating' => 'nullable|integer',
        ]);

        Review::create($validatedData);

        return Redirect::route('reviewlist.search')->with('message', 'New review has been successfully added');
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'desc' => 'nullable|string',
            'image_url' => 'nullable|string',
            'rating' => 'nullable|integer',
        ]);
        $review->update($validatedData);

        return Redirect::route('reviewlist.search')->with('message', 'A review has been successfully updated');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return Redirect::route('reviewlist.search')->with('message', 'A review has been successfully deleted');
    }

}
