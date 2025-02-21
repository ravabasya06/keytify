<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'user' => function () {
                return Auth::user();
            },

            'cart_count' => function () {
                if (app()->runningInConsole()) {
                    return 0;
                }

                $user_id = Auth::id();
                $session_id = Session::getId();

                $cart_items = Cart::where(function ($query) use ($user_id, $session_id) {
                    if ($user_id) {
                        $query->where('user_id', $user_id);
                    } else {
                        $query->where('session_id', $session_id);
                    }
                })
                ->sum('quantity');
                
                return $cart_items;
            },
        ]);
    }
}
