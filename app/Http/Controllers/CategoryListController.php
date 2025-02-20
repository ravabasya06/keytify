<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Category;

class CategoryListController extends Controller
{
    public function index(Request $request){ 
        $query = $request->input('search_query');

        if($query){
            $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->select(['category_id', 'name', 'slug', 'desc', 'image_url'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }
        else {
            $categories = Category::select(['category_id', 'name', 'slug', 'desc', 'image_url'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }

        return Inertia::render('CategoryList', [
            'categories' => $categories,
        ]);
    }

    public function filter($slug){
        $query = Category::select(['category_id', 'name', 'slug', 'desc', 'image_url']);

        if ($slug === 'alphabet-ascending') {
            $query->orderBy('name');
        } elseif ($slug === 'alphabet-descending') {
            $query->orderByDesc('name');
        }

        $categories = $query->paginate(10)->withQueryString()->onEachSide(1);
        return Inertia::render('CategoryList', [
            'categories' => $categories,
            'slug' => $slug
        ]);
    }

}
