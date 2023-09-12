<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home(){

        //get featured products;
        $featuredProducts = Product::latest()->where('is_featured','yes')->where('status','active')->take(8)->get();
        // get latest 8 products
        $latestProducts = Product::latest()->where('status','active')->take(8)->get();

        return view('front.home', compact('featuredProducts','latestProducts'));
    }
}
