<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {
            $navCartItems = collect();

            if (auth()->check()) {
                $cart = auth()->user()->cart;
                $navCartItems = $cart ? $cart->items()->with('product')->latest('id')->get() : collect();
            }

            $view->with('navCartItems', $navCartItems);
            $view->with('navCartCount', $navCartItems->sum('quantity'));
        });
    }
}
