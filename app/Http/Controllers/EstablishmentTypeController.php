<?php

namespace App\Http\Controllers;

use App\Models\EstablishmentType;
use Illuminate\Http\Request;

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
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,60',
            'state' => 'required'
        ]);

        EstablishmentType::create(
            [
                'name' => $request->name,
                'state' => $request->state,
            ]
        );

        return redirect()->route('establishment_types.index');
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
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,60',
            'state' => 'required'
        ]);

        $establishmentType->update(
            [
                'name' => $request->name,
                'state' => $request->state,
            ]
        );

        return redirect()->route('establishment_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstablishmentType $establishmentType)
    {
        $establishmentType->delete();
        return redirect()->route('establishment_types.index');
    }
}
