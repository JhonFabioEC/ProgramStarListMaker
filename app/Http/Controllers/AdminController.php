<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    public function welcomeAdmin(){
        return view('admin.WelcomeAdminView');
    }

    public function welcomeEstablishment(){
        return view('admin.WelcomeEstablishmentView');
    }

    public function welcomeUser(){
        $categories = Category::where('state', '=', 'true')->get();
        $brands = Brand::where('state', '=', 'true')->get();
        $products = Product::where('state', '=', 'true')->get();

        return view('admin.WelcomeUserView', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products
        ]);
    }
}
