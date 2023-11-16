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
        $products = Product::where('state', '=', 'true')->get();

        return view('home.SearchArticlesView', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products
        ]);
    }

    public function getProductsByCategory($id){
        $categories = Category::where('state', true)->get();
        $brands = Brand::where('state', true)->get();

        if ($id == 'all') {
            $products = Product::where('state', true)->get();
        } else {
            $category = Category::find($id);

            if ($category && $category->state == true) {
                $products = Product::where('state', true)->where('category_id', $category->id)->get();
            }
        }

        return view('home.SearchArticlesView', [
            'category_id' => $id,
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products
        ]);
    }

    public function getProductsByBrand($id){
        $categories = Category::where('state', true)->get();
        $brands = Brand::where('state', true)->get();

        if ($id == 'all') {
            $products = Product::where('state', true)->get();
        } else {
            $brand = Brand::find($id);

            if ($brand && $brand->state == true) {
                $products = Product::where('state', true)->where('brand_id', $brand->id)->get();
            }
        }

        return view('home.SearchArticlesView', [
            'brand_id' => $id,
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products
        ]);
    }

    public function getProductsByName(Request $request){
        $categories = Category::where('state', true)->get();
        $brands = Brand::where('state', true)->get();

        if ($request->search == '') {
            $products = Product::where('state', true)->get();
        } else {
            $products = Product::where('state', true)->where('name', 'ilike', '%' . $request->search . '%')->get();
        }

        return view('home.SearchArticlesView', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products
        ]);
    }
}
