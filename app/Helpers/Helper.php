<?php

namespace App\Helpers;

use App\Models\Message;
use App\Models\Category;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Shipping;
use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function messageList()
    {
        return Message::whereNull('read_at')->orderBy('created_at', 'desc')->get();
    }

    public static function getAllCategory()
    {
        $category = new Category();
        return $category->getAllParentWithChild();
    }

    public static function getHeaderCategory()
    {
        $menu = self::getAllCategory();

        if ($menu) {
            echo '<li>
                <a href="javascript:void(0);">Danh mục<i class="ti-angle-down"></i></a>
                <ul class="dropdown border-0 shadow">';

            foreach ($menu as $cat) {
                if ($cat->child_cat->count() > 0) {
                    echo '<li>
                        <a href="'.route('product-cat', $cat->slug).'">'.$cat->title.'</a>
                        <ul class="dropdown sub-dropdown border-0 shadow">';

                    foreach ($cat->child_cat as $sub) {
                        echo '<li>
                            <a href="'.route('product-sub-cat', [$cat->slug, $sub->slug]).'">'.$sub->title.'</a>
                        </li>';
                    }

                    echo '</ul></li>';
                } else {
                    echo '<li>
                        <a href="'.route('product-cat', $cat->slug).'">'.$cat->title.'</a>
                    </li>';
                }
            }

            echo '</ul></li>';
        }
    }

    public static function cartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', auth()->id())
                ->whereNull('order_id')
                ->sum('quantity');
        }
        return 0;
    }

    public static function getAllProductFromCart()
    {
        if (Auth::check()) {
            return Cart::with('product')
                ->where('user_id', auth()->id())
                ->whereNull('order_id')
                ->get();
        }
        return collect();
    }

    public static function totalCartPrice()
    {
        if (Auth::check()) {
            return Cart::where('user_id', auth()->id())
                ->whereNull('order_id')
                ->sum('amount');
        }
        return 0;
    }

    public static function wishlistCount()
    {
        if (Auth::check()) {
            return Wishlist::where('user_id', auth()->id())
                ->whereNull('cart_id')
                ->sum('quantity');
        }
        return 0;
    }

    public static function getAllProductFromWishlist()
    {
        if (Auth::check()) {
            return Wishlist::with('product')
                ->where('user_id', auth()->id())
                ->whereNull('cart_id')
                ->get();
        }
        return collect();
    }

    public static function totalWishlistPrice()
    {
        if (Auth::check()) {
            return Wishlist::where('user_id', auth()->id())
                ->whereNull('cart_id')
                ->sum('amount');
        }
        return 0;
    }

    public static function shipping()
    {
        return Shipping::orderBy('id', 'DESC')->get();
    }
}
