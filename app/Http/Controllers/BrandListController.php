<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Brand;

class BrandListController extends Controller
{
    public function index(Request $request){ 
        $query = $request->input('search_query');

        if($query){
            $brands = Brand::where('name', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->select(['brand_id', 'name', 'slug', 'desc', 'image_url'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }
        else {
            $brands = Brand::select(['brand_id', 'name', 'slug', 'desc', 'image_url'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }

        return Inertia::render('BrandList', [
            'brands' => $brands,
        ]);
    }

    public function filter($slug){
        $query = Brand::select(['brand_id', 'name', 'slug', 'desc', 'image_url']);

        if ($slug === 'alphabet-ascending') {
            $query->orderBy('name');
        } elseif ($slug === 'alphabet-descending') {
            $query->orderByDesc('name');
        }

        $brands = $query->paginate(10)->withQueryString()->onEachSide(1);
        return Inertia::render('BrandList', [
            'brands' => $brands,
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

        Brand::create($validatedData);

        return Redirect::route('brandlist.search')->with('message', 'New brand has been successfully added');
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:brands|string|max:255',
            'desc' => 'nullable|string',
            'image_url' => 'nullable',
        ]);
        $brand->update($validatedData);

        return Redirect::route('brandlist.search')->with('message', 'A brand has been successfully updated');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return Redirect::route('brandlist.search')->with('message', 'A brand has been successfully deleted');
    }
}
