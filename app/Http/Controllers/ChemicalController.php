<?php
// app/Http/Controllers/ChemicalController.php

namespace App\Http\Controllers;

use App\Models\Chemical; // Make sure to import the Chemical model
use App\Models\DangerousProperty;
use App\Models\MeasureUnit;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ChemicalController extends Controller
{

    public function index(Request $request) :View
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
        if ($measureUnitId) {
            $query->where('measure_unit_id', 'like', '%' . $measureUnitId . '%');
        }

        if ($request->has('dangerous_properties')) {
            $selectedProperties = $request->input('dangerous_properties');
            $query->whereHas('dangerousProperties', function ($query) use ($selectedProperties) {
                $query->whereIn('dangerous_property_id', $selectedProperties);
            });
        } else
            $selectedProperties = [];

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
        // Fetch all measure units for the filter
        $measureUnits = MeasureUnit::all();
        $dangerousProperties = DangerousProperty::all();

        return view('chemicals.index',
            compact('chemicals', 'sortColumn',
                'sortDirection', 'measureUnits', 'dangerousProperties', 'selectedProperties'));
    }

    public function create(): View
    {
        $dangerousProperties = DangerousProperty::all();
        $measureUnits = MeasureUnit::all(); // Fetch all measure units
        return view('chemicals.create', compact('measureUnits', 'dangerousProperties'));
    }

    public function store(Request $request): RedirectResponse
    {
        Log::info('This is a test log message.');
        $request->validate([
            'chemical_name_en' => 'required|string|max:255',
            'chemical_name_sk' => 'required|string|max:255',
            'chemical_formula' => 'required|string|max:255',
            'quantity' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/',
            'measure_unit_id' => 'required|exists:measure_units,id',
            'description_en' => 'nullable|string',
            'description_sk' => 'nullable|string',
            'dangerous_properties' => 'array', // Validate as an array
            'dangerous_properties.*' => 'exists:dangerous_properties,id', // Validate each ID exists
        ]);

        $chemical = Chemical::create($request->all());

        if ($request->has('dangerous_properties')) {
            $chemical->dangerousProperties()->attach($request->dangerous_properties);
        }

        return redirect()->route('chemicals.index')->with('success', 'Chemical created successfully.');
    }

    public function show($id): View
    {
        $chemical = Chemical::with(['measureUnit', 'dangerousProperties'])->findOrFail($id);
        return view('chemicals.show', compact('chemical'));
    }

    public function edit(Chemical $chemical): View
    {
        $dangerousProperties = DangerousProperty::all();
        $selectedProperties = $chemical->dangerousProperties->pluck('id')->toArray(); // Get the IDs of the associated dangerous properties
        $measureUnits = MeasureUnit::all(); // Fetch all measure units
        return view('chemicals.edit', compact(
            'chemical', 'measureUnits', 'dangerousProperties', 'selectedProperties'));
    }

    public function update(Request $request, Chemical $chemical): RedirectResponse
    {
        $request->validate([
            'chemical_name_en' => 'required|string|max:255',
            'chemical_name_sk' => 'required|string|max:255',
            'chemical_formula' => 'required|string|max:255',
            'quantity' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/',
            'measure_unit_id' => 'required|exists:measure_units,id',
            'description_en' => 'nullable|string',
            'description_sk' => 'nullable|string',
            'dangerous_properties' => 'array', // Validate as an array
            'dangerous_properties.*' => 'exists:dangerous_properties,id', // Validate each ID exists
        ]);

        $chemical->update($request->all());
        $chemical->dangerousProperties()->sync($request->dangerous_properties);

        return redirect()->route('chemicals.index')->with('success', 'Chemical updated successfully.');
    }

    public function destroy(Chemical $chemical): RedirectResponse
    {
        $chemical->delete();
        return redirect()->route('chemicals.index')->with('success', 'Chemical deleted successfully.');
    }
}
