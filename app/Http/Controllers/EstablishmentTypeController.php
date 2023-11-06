<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstablishmentType;
use Illuminate\Database\QueryException;

class EstablishmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $establishmentTypes = EstablishmentType::get();
        return view('admin.establishmentType.ManagementEstablishmentTypesView', ['establishmentTypes' => $establishmentTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.establishmentType.CreateEstablishmentType', ['establishmentType' => null]);
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
            EstablishmentType::create(
                [
                    'name' => $request->name,
                    'state' => $request->state,
                ]
            );

            $message = 'establecimiento creado';
            return redirect()->route('establishment_types.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no pudo crear el establecimiento';
            return redirect()->route('establishment_types.index')->with('error', $message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EstablishmentType $establishmentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EstablishmentType $establishmentType)
    {
        return view('admin.establishmentType.EditEstablishmentType', ['establishmentType' => $establishmentType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EstablishmentType $establishmentType)
    {
        $request->validate([
            'name' => 'required|between:3,60',
            'state' => 'required'
        ]);

        try {
            $establishmentType->update(
                [
                    'name' => $request->name,
                    'state' => $request->state,
                ]
            );

            $message = 'establecimiento actualizado';
            return redirect()->route('establishment_types.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'no pudo actualizar el establecimiento';
            return redirect()->route('establishment_types.index')->with('error', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstablishmentType $establishmentType)
    {
        try {
            $establishmentType->delete();
            $message = 'establecimiento eliminado';
            return redirect()->route('establishment_types.index')->with('success', $message);
        } catch (QueryException $e) {
            $message = 'el establecimiento no puede ser eliminado';
            return redirect()->route('establishment_types.index')->with('error', $message);
        }
    }
}
