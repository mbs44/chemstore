<?php
// app/Http/Controllers/ChemicalController.php

namespace App\Http\Controllers;

use App\Models\Chemical; // Make sure to import the Chemical model
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ChemicalController extends Controller
{

        public function index(Request $request)
    {
        // Get the filter parameters from the request
        $chemicalNameEn = $request->input('chemical_name_en');
        $chemicalNameSk = $request->input('chemical_name_sk');
        $chemicalFormula = $request->input('chemical_formula');
        $quantity = $request->input('quantity');
        $measureUnitId = $request->input('measure_unit_id');

        // Start the query
        $query = Chemical::query();

        // Apply the filter parameters to the database query
        if ($chemicalNameEn) {
            $query->where('chemical_name_en', 'like', '%' . $chemicalNameEn . '%');
        }
        if ($chemicalNameSk) {
            $query->where('chemical_name_sk', 'like', '%' . $chemicalNameEn . '%');
        }
        if ($chemicalFormula) {
            $query->where('chemical_formula', 'like', '%' . $chemicalFormula . '%');
        }
        if ($quantity) {
            $query->where('quantity', $quantity);
        }
        if ($measureUnitId) {
            $query->where('measure_unit_id', 'like', '%' . $measureUnitId . '%');
        }

        // Get the sort column and direction from the request
        $sortColumn = $request->get('sort', 'chemical_formula'); // Default sort by chemical name
        $sortDirection = $request->get('direction', 'asc'); // Default direction

        // Validate the sort column and direction
        $validColumns = ['chemical_formula', 'chemical_name_en', 'chemical_name_sk',
            'quantity', 'measure_unit_id', 'created_at', 'updated_at'];
        if (!in_array($sortColumn, $validColumns)) {
            $sortColumn = 'chemical_formula';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Retrieve chemicals with sorting and pagination
        $chemicals = $query->orderBy($sortColumn, $sortDirection)->paginate(25);

        return view('chemicals.index', compact('chemicals', 'sortColumn', 'sortDirection'));
    }

    public function create(): View
    {
        return view('chemicals.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Log::info('This is a test log message.');
        $request->validate([
            'chemical_name_en' => 'required|string|max:255',
            'chemical_name_sk' => 'required|string|max:255',
            'chemical_formula' => 'required|string|max:255',
            'quantity' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/',
            'measure_unit_id' => 'required|integer',
            'description' => 'nullable|string',
        ]);
        Log::info('Validation passed.');
        DB::enableQueryLog();
        Chemical::create($request->all());
        Log::info(DB::getQueryLog());
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
            'quantity' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/',
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
