<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $categories = Category::where('state', '=', 'true')->get();
        $brands = Brand::where('state', '=', 'true')->get();
        $products = Product::get();

        return view('home.SearchArticlesView', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products
        ]);
    }

    public function login(){
        return view('home.LoginView');
    }
}
