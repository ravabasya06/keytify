<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\User;

class UserListController extends Controller
{
    public function index(Request $request){ 
        $query = $request->input('search_query');

        if($query){
            $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('id', 'LIKE', "%{$query}%")
            ->select(['id', 'name', 'email', 'isAdmin', 'created_at', 'updated_at'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }
        else {
            $users = User::select(['id', 'name', 'email', 'isAdmin', 'created_at', 'updated_at'])
            ->paginate(10)->withQueryString()->onEachSide(1);
        }

        return Inertia::render('UserList', [
            'users' => $users,
        ]);
    }

    public function filter($slug){
        $query = User::select(['id', 'name', 'email', 'isAdmin', 'created_at', 'updated_at']);

        if ($slug === 'alphabet-ascending') {
            $query->orderBy('name');
        } elseif ($slug === 'alphabet-descending') {
            $query->orderByDesc('name');
        } elseif ($slug === 'admin-ascending') {
            $query->orderBy('isAdmin');
        } elseif ($slug === 'admin-descending') {
            $query->orderByDesc('isAdmin');
        }

        $users = $query->paginate(10)->withQueryString()->onEachSide(1);
        return Inertia::render('UserList', [
            'users' => $users,
            'slug' => $slug
        ]);
    }

}
