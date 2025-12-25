<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;

class CartController extends Controller
{
    protected $product = null;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    // ---------------------------
    // ADD TO CART
    // ---------------------------
    public function addToCart(Request $request)
    {
        if (empty($request->slug)) return back()->with('error','Invalid Products');
        
        $product = Product::where('slug', $request->slug)->first();
        if (!$product) return back()->with('error','Invalid Products');

        $already_cart = Cart::where('user_id', auth()->user()->id)
                            ->where('order_id', null)
                            ->where('product_id', $product->id)
                            ->first();

        if($already_cart){
            $already_cart->quantity += 1;
            $already_cart->amount += ($product->price - ($product->price * $product->discount) / 100);
            if ($already_cart->product->stock < $already_cart->quantity)
                return back()->with('error','Stock not sufficient!');
            $already_cart->save();
        } else {
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = $product->price - ($product->price * $product->discount / 100);
            $cart->quantity = 1;
            $cart->amount = $cart->price;
            if ($cart->product->stock < 1) return back()->with('error','Stock not sufficient!');
            $cart->save();
        }

        // AUTO REMOVE COUPON
        session()->forget('coupon');

        return back()->with('success','Product successfully added to cart');
    }

    // ---------------------------
    // SINGLE ADD
    // ---------------------------
    public function singleAddToCart(Request $request)
    {
        $request->validate([
            'slug'=>'required',
            'quant'=>'required'
        ]);

        $product = Product::where('slug', $request->slug)->first();
        if(!$product) return back()->with('error','Invalid Products');

        $qty = $request->quant[1];
        if($product->stock < $qty) return back()->with('error','Out of stock');

        $already_cart = Cart::where('user_id', auth()->user()->id)
                            ->where('order_id', null)
                            ->where('product_id', $product->id)
                            ->first();

        if($already_cart){
            $already_cart->quantity += $qty;
            $already_cart->amount += ($product->price * $qty);
            if ($already_cart->product->stock < $already_cart->quantity)
                return back()->with('error','Stock not sufficient!');
            $already_cart->save();
        } else {
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = $product->price - ($product->price * $product->discount / 100);
            $cart->quantity = $qty;
            $cart->amount = $product->price * $qty;
            if ($cart->product->stock < $qty) return back()->with('error','Stock not sufficient!');
            $cart->save();
        }

        session()->forget('coupon');

        return back()->with('success','Product successfully added to cart.');
    }

    // ---------------------------
    // DELETE CART
    // ---------------------------
    public function cartDelete(Request $request)
    {
        $cart = Cart::find($request->id);
        if ($cart){
            $cart->delete();
            session()->forget('coupon');
            return back()->with('success','Cart removed');
        }
        return back()->with('error','Failed to remove');
    }

    // ---------------------------
    // UPDATE CART
    // ---------------------------
    public function cartUpdate(Request $request)
    {
        if($request->quant){
            foreach ($request->quant as $key=>$quant){
                $cart_id = $request->qty_id[$key];
                $cart = Cart::find($cart_id);

                if($quant > 0 && $cart){
                    if($cart->product->stock < $quant)
                        return back()->with('error','Out of stock');

                    $price = $cart->product->price - ($cart->product->price*$cart->product->discount/100);
                    $cart->quantity = $quant;
                    $cart->amount = $price * $quant;
                    $cart->save();
                }
            }

            session()->forget('coupon');

            return back()->with('success','Cart updated');
        }

        return back()->with('error','Invalid Cart');
    }

    // ---------------------------
    // CHECKOUT PAGE
    // ---------------------------
    public function checkout(Request $request)
    {
        return view('frontend.pages.checkout');
    }
}
