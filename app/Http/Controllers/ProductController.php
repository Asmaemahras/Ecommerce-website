<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // un produit alétoire
    public function index()
    {
    $products = Product::inRandomOrder()
    ->whereActive(true) // equiv where active = true !
    ->take(16)
    ->get();
    return view('products.index', compact('products'));
    }
}
