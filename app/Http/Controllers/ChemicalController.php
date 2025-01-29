<?php
// app/Http/Controllers/ChemicalController.php

namespace App\Http\Controllers;

use App\Models\Chemical; // Make sure to import the Chemical model
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ChemicalController extends Controller
{
    public function index(): View
    {
        $chemicals = Chemical::paginate(10); // Paginate results
        return view('chemicals.index', compact('chemicals'));
    }

    public function create(): View
    {
        return view('chemicals.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'chemical_name_en' => 'required|string|max:255',
            'chemical_name_sk' => 'required|string|max:255',
            'chemical_formula' => 'required|string|max:255',
            'quantity' => 'required|decimal',
            'measure_unit_id' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Chemical::create($request->all());
        return redirect()->route('chemicals.index')->with('success', 'Chemical created successfully.');
    }

    public function show(Chemical $chemical): View
    {
        return view('chemicals.show', compact('chemical'));
    }

    public function edit(Chemical $chemical): View
    {
        return view('chemicals.edit', compact('chemical'));
    }

    public function update(Request $request, Chemical $chemical): RedirectResponse
    {
        $request->validate([
            'chemical_name_en' => 'required|string|max:255',
            'chemical_name_sk' => 'required|string|max:255',
            'chemical_formula' => 'required|string|max:255',
            'quantity' => 'required|decimal',
            'measure_unit_id' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $chemical->update($request->all());
        return redirect()->route('chemicals.index')->with('success', 'Chemical updated successfully.');
    }

    public function destroy(Chemical $chemical): RedirectResponse
    {
        $chemical->delete();
        return redirect()->route('chemicals.index')->with('success', 'Chemical deleted successfully.');
    }
}
