<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Establishment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $establishment = Establishment::where('user_id', '=', Auth::user()->id)->get();
        $products = Product::where('establishment_id', '=', $establishment[0]->id)->get();
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
            'name' => 'required|between:3,60',
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

        try {
            $imageName = time() . '.' . $request->image->extension();
            $establishment = Establishment::where('user_id', '=', Auth::user()->id)->get();

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
                    'establishment_id' => $establishment[0]->id
                ]
            );

            $request->image->move(public_path('storage/products'), $imageName);

            $message = 'producto creado';
            return redirect()->route('products.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no pudo crear el producto';
            return redirect()->route('products.index')->with('error', $message);
        }
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
            'name' => 'required|between:3,60',
            'price'  => 'required|integer|between:100,9999999',
            'stock'  => 'required|integer|between:0,1000',
            'barcode'  => 'required|integer',
            'section'  => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2040',
            'description'  => 'required',
            'state'  => 'required',
            'category_id'  => 'required',
            'brand_id'  => 'required'
        ]);

        try {
            $establishment = Establishment::where('user_id', '=', Auth::user()->id)->get();

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();

                if ($product->image && $product->image != 'default.svg' && File::exists(public_path('storage/products/' . $product->image))) {
                    File::delete(public_path('storage/products/' . $product->image));
                }

                $request->image->move(public_path('storage/products'), $imageName);

                $product->update(['image' => $imageName]);
            }

            $product->update(
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'barcode' => $request->barcode,
                    'section' => $request->section,
                    'description' => $request->description,
                    'state' => $request->state,
                    'category_id' => $request->category_id,
                    'brand_id' => $request->brand_id,
                    'establishment_id' => $establishment[0]->id
                ]
            );

            $message = 'producto actualizado';
            return redirect()->route('products.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no pudo actualizar el producto';
            return redirect()->route('products.index')->with('error', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->image && $product->image != 'default.svg' && File::exists(public_path('storage/products/' . $product->image))) {
                File::delete(public_path('storage/products/' . $product->image));
            }

            $product->delete();
            $message = 'producto eliminado';
            return redirect()->route('products.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'el producto no puede ser eliminado';
            return redirect()->route('products.index')->with('error', $message);
        }
    }
}
