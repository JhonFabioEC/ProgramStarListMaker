<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::get();
        return view('admin.brand.ManagementBrandsView', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.CreateBrands', ['brand' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|between:3,60',
            'state' => 'required'
        ]);

        try {
            Brand::create(
                [
                    'name' => $request->name,
                    'state' => $request->state,
                ]
            );

            $message = 'marca creada';
            return redirect()->route('brands.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no pudo crear la marca';
            return redirect()->route('brands.index')->with('error', $message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.EditBrands', ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|between:3,60',
            'state' => 'required'
        ]);

        try {
            $brand->update(
                [
                    'name' => $request->name,
                    'state' => $request->state,
                ]
            );

            $message = 'marca actualizada';
            return redirect()->route('brands.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no pudo actualizar la marca';
            return redirect()->route('brands.index')->with('error', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
            $message = 'marca eliminada';
            return redirect()->route('brands.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'la marca no puede ser eliminada';
            return redirect()->route('brands.index')->with('error', $message);
        }
    }
}
