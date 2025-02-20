<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

}
