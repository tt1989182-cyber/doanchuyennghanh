<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class TryOnController extends Controller
{
    public function index()
    {
        // Lấy danh sách sản phẩm name + image
       $products = Product::select('title', 'photo')->get();


        return view('frontend.pages.tryon', compact('products'));
    }
}
