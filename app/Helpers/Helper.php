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
        return Message::whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->get();
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
                        <a href="'.route('product-cat',$cat->slug).'">'.$cat->title.'</a>
                        <ul class="dropdown sub-dropdown border-0 shadow">';
                    
                    foreach ($cat->child_cat as $sub) {
                        echo '<li>
                            <a href="'.route('product-sub-cat',[$cat->slug,$sub->slug]).'">'.$sub->title.'</a>
                        </li>';
                    }

                    echo '</ul></li>';
                } else {
                    echo '<li>
                        <a href="'.route('product-cat',$cat->slug).'">'.$cat->title.'</a>
                    </li>';
                }
            }

            echo '</ul></li>';
        }
    }

    public static function cartCount($user_id = null)
    {
        if (!Auth::check()) return 0;
        $user_id = $user_id ?? auth()->id();

        return Cart::where('user_id',$user_id)
            ->whereNull('order_id')
            ->sum('quantity');
    }

    public static function getAllProductFromCart($user_id = null)
    {
        if (!Auth::check()) return collect();
        $user_id = $user_id ?? auth()->id();

        return Cart::with('product')
            ->where('user_id',$user_id)
            ->whereNull('order_id')
            ->get();
    }

    public static function totalCartPrice($user_id = null)
    {
        if (!Auth::check()) return 0;
        $user_id = $user_id ?? auth()->id();

        return Cart::where('user_id',$user_id)
            ->whereNull('order_id')
            ->sum('amount');
    }

    public static function wishlistCount($user_id = null)
    {
        if (!Auth::check()) return 0;
        $user_id = $user_id ?? auth()->id();

        return Wishlist::where('user_id',$user_id)
            ->whereNull('cart_id')
            ->sum('quantity');
    }

    public static function getAllProductFromWishlist($user_id = null)
    {
        if (!Auth::check()) return collect();
        $user_id = $user_id ?? auth()->id();

        return Wishlist::with('product')
            ->where('user_id',$user_id)
            ->whereNull('cart_id')
            ->get();
    }

    public static function totalWishlistPrice($user_id = null)
    {
        if (!Auth::check()) return 0;
        $user_id = $user_id ?? auth()->id();

        return Wishlist::where('user_id',$user_id)
            ->whereNull('cart_id')
            ->sum('amount');
    }

    public static function shipping()
    {
        return Shipping::orderBy('id','DESC')->get();
    }
}

/* ===== GLOBAL FUNCTION ===== */
if (!function_exists('generateUniqueSlug')) {
    function generateUniqueSlug($title, $modelClass)
    {
        $slug = Str::slug($title);
        if ($modelClass::where('slug',$slug)->exists()) {
            $slug .= '-' . time();
        }
        return $slug;
    }
}
