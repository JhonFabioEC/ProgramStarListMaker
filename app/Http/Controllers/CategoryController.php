<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.category.ManagementCategoriesView', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.CreateCategories', ['category' => null]);
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
            Category::create(
                [
                    'name' => $request->name,
                    'state' => $request->state,
                ]
            );

            $message = 'categoría creada';
            return redirect()->route('categories.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no pudo crear la categoría';
            return redirect()->route('categories.index')->with('error', $message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.EditCategories', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|between:3,60',
            'state' => 'required'
        ]);

        try {
            $category->update(
                [
                    'name' => $request->name,
                    'state' => $request->state,
                ]
            );

            $message = 'categoría actualizada';
            return redirect()->route('categories.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no pudo actualizar la categoría';
            return redirect()->route('categories.index')->with('error', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            $message = 'categoría eliminada';
            return redirect()->route('categories.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'la categoría no puede ser eliminada';
            return redirect()->route('categories.index')->with('error', $message);
        }
    }
}
