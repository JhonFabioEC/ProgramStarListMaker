<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('establishment_id', '=', '1')->get();
        return view('admin.product.ManagementProductsView', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('state', '=', 'true')->get();
        $brands = Brand::where('state', '=', 'true')->get();
        return view('admin.product.CreateProduct', [
            'categories' => $categories,
            'brands' => $brands,
            'product' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,60',
            'price'  => 'required|integer|between:100,9999999',
            'stock'  => 'required|integer|between:0,1000',
            'barcode'  => 'required|integer',
            'section'  => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2040',
            'description'  => 'required',
            'state'  => 'required',
            'category_id'  => 'required',
            'brand_id'  => 'required'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/products'), $imageName);

        Product::create(
            [
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'barcode' => $request->barcode,
                'section' => $request->section,
                'image' => $imageName,
                'description' => $request->description,
                'state' => $request->state,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'establishment_id' => 1
                // 'establishment_id' => $request->establishment_id
            ]
        );

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('state', '=', 'true')->get();
        $brands = Brand::where('state', '=', 'true')->get();
        return view('admin.product.EditProduct', [
            'categories' => $categories,
            'brands' => $brands,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,60',
            'price'  => 'required|integer|between:100,9999999',
            'stock'  => 'required|integer|between:0,1000',
            'barcode'  => 'required|integer',
            'section'  => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2040',
            'description'  => 'required',
            'state'  => 'required',
            'category_id'  => 'required',
            'brand_id'  => 'required'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/products'), $imageName);

        $product->update(
            [
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'barcode' => $request->barcode,
                'section' => $request->section,
                'image' => $imageName,
                'description' => $request->description,
                'state' => $request->state,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'establishment_id' => 1
                // 'establishment_id' => $request->establishment_id
            ]
        );

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
