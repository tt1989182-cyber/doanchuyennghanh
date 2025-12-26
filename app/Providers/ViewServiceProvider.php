<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('frontend.layouts.header', function ($view) {

            $categories = Category::with('child_cat')->whereNull('parent_id')->get();

            $wishlistCount = 0;
            $cartCount = 0;
            $wishlistItems = collect();
            $wishlistTotal = 0;

            if (Auth::check()) {
                $wishlistCount = Wishlist::where('user_id', auth()->id())
                    ->whereNull('cart_id')->sum('quantity');

                $cartCount = Cart::where('user_id', auth()->id())
                    ->whereNull('order_id')->sum('quantity');

                $wishlistItems = Wishlist::with('product')
                    ->where('user_id', auth()->id())
                    ->whereNull('cart_id')->get();

                $wishlistTotal = Wishlist::where('user_id', auth()->id())
                    ->whereNull('cart_id')->sum('amount');
            }

            $settings = DB::table('settings')->get();

            $view->with(compact(
                'categories',
                'wishlistCount',
                'cartCount',
                'wishlistItems',
                'wishlistTotal',
                'settings'
            ));
        });
    }
}
