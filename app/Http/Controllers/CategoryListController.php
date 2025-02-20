<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'desc' => 'nullable|string',
            'image_url' => 'nullable|string',
        ]);

        Category::create($validatedData);

        return Redirect::route('categorylist.search')->with('message', 'New category has been successfully added');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories|string|max:255',
            'desc' => 'nullable|string',
            'image_url' => 'nullable',
        ]);
        $category->update($validatedData);

        return Redirect::route('categorylist.search')->with('message', 'A category has been successfully updated');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return Redirect::route('categorylist.search')->with('message', 'A category has been successfully deleted');
    }
}
