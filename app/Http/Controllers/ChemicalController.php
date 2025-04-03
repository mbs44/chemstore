<?php
// app/Http/Controllers/ChemicalController.php

namespace App\Http\Controllers;

use App\Models\Chemical; // Make sure to import the Chemical model
use App\Models\DangerousProperty;
use App\Models\MeasureUnit;
use App\Models\SafetyItem;
use App\Models\Supplies;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

/**
 * Implements CRUD on chemicals
 */
class ChemicalController extends Controller
{

    /**
     * implements search logic and returns result to index blade
     * @param Request $request
     * @return View
     */
    public function index(Request $request) :View
    {
        // Get the filter parameters from the request
        $chemicalNameEn = $request->input('chemical_name_en');
        $chemicalNameSk = $request->input('chemical_name_sk');
        $chemicalFormula = $request->input('chemical_formula');
        $supplies_id = $request->input('supplies_id');
        $measureUnitId = $request->input('measure_unit_id');

        // Start the query builder
        $query = Chemical::query();

        // Apply the filter parameters to the database query using predefined operators
        if ($chemicalNameEn) {
            $query->where('chemical_name_en', 'like', '%' . $chemicalNameEn . '%');
        }
        if ($chemicalNameSk) {
            $query->where('chemical_name_sk', 'like', '%' . $chemicalNameSk . '%');
        }
        if ($chemicalFormula) {
            $query->where('chemical_formula', 'like', '%' . $chemicalFormula . '%');
        }
        if ($supplies_id) { //TODO: replace with availability  high, low, empty
            $query->where('supplies_id', $supplies_id);
        }
        if ($measureUnitId) {
            $query->where('measure_unit_id',  $measureUnitId);
        }

        // dangerous properties are searched by joining chemical_dangerous_properties
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
            'supplies_id', 'measure_unit_id', 'created_at', 'updated_at'];
        if (!in_array($sortColumn, $validColumns)) {
            $sortColumn = 'chemical_formula';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Retrieve chemicals with sorting and pagination
        $chemicals = $query->orderBy($sortColumn, $sortDirection)->paginate(25);
        // Fetch all code table values from measure units, supplies and dangerous properties
        $measureUnits = MeasureUnit::all();
        $supplies = Supplies::all();
        $dangerousProperties = DangerousProperty::all();

        //provide security flag for teachers
        $allowEdit = $this->checkRoles([ 'admin', 'teacher']);
        return view('chemicals.index',
            compact('chemicals', 'sortColumn',
                'sortDirection', 'measureUnits', 'dangerousProperties', 'supplies',
                'selectedProperties', 'allowEdit'));
    }

    /**
     * calls create blade template
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->assertRoles( [ 'admin', 'teacher']);

        // Fetch all code table values from measure units, safety items, supplies and dangerous properties
        $dangerousProperties = DangerousProperty::all();
        $safetyItems = SafetyItem::all();
        $supplies = Supplies::all();
        $measureUnits = MeasureUnit::all(); // Fetch all measure units
        return view('chemicals.create', compact('measureUnits', 'supplies',
            'dangerousProperties', 'safetyItems'));
    }

    /**
     * creates new chemical in database
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);

        $request->validate([
            'chemical_name_en' => 'required|string|max:255',
            'chemical_name_sk' => 'required|string|max:255',
            'chemical_formula' => 'required|string|max:255',
            'supplies_id' =>  'required|exists:supplies,id',
            'measure_unit_id' => 'required|exists:measure_units,id',
            'disposal_en' => 'required|string|max:255',
            'disposal_sk' => 'required|string|max:255',
            'access_en' => 'required|string|max:255',
            'access_sk' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_sk' => 'nullable|string',
            'safety_items' => 'array', // Validate as an array
            'safety_items.*' => 'exists:safety_items,id', // Validate each ID exists
            'dangerous_properties' => 'array', // Validate as an array
            'dangerous_properties.*' => 'exists:dangerous_properties,id', // Validate each ID exists
        ]);

        // create new chemical
        $chemical = Chemical::create($request->all());

        // attach dangerous properties
        if ($request->has('dangerous_properties')) {
            $chemical->dangerousProperties()->attach($request->dangerous_properties);
        }

        // attach safety items
        if ($request->has('safety_items')) {
            $chemical->safetyItems()->attach($request->safety_items);
        }

        // redirect to search
        return redirect()->route('chemicals.index')->with('success', 'Chemical created successfully.');
    }

    /**
     * calls chemical show detail blade
     * @param $id
     * @return View
     */
    public function show($id): View
    {
        $isTeacher = $this->checkRoles([ 'admin', 'teacher']);

        // Fetch all code table values from measure units, supplies and dangerous properties
        $chemical = Chemical::with(['measureUnit', 'supplies', 'dangerousProperties'])->findOrFail($id);
        return view('chemicals.show', compact('chemical',   'isTeacher'));
    }

    /**
     * calls edit blade
     * @param Chemical $chemical
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Chemical $chemical): View
    {
        $this->assertRoles( [ 'admin', 'teacher']);

        // Fetch all code table values from measure units, supplies and dangerous properties
        $dangerousProperties = DangerousProperty::all();
        $safetyItems = SafetyItem::all();
        $supplies = Supplies::all();
        $measureUnits = MeasureUnit::all(); // Fetch all measure units

        // select current attached values
        $selectedItems = $chemical->safetyItems->pluck('id')->toArray();
        $selectedProperties = $chemical->dangerousProperties->pluck('id')->toArray(); // Get the IDs of the associated dangerous properties

        return view('chemicals.edit', compact(
            'chemical', 'measureUnits', 'supplies', 'safetyItems',
            'dangerousProperties', 'selectedProperties', 'selectedItems'));
    }


    /**
     * updates chemical in database
     * @param Request $request
     * @param Chemical $chemical
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Chemical $chemical): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);

        $request->validate([
            'chemical_name_en' => 'required|string|max:255',
            'chemical_name_sk' => 'required|string|max:255',
            'chemical_formula' => 'required|string|max:255',
            'supplies_id' =>  'required|exists:supplies,id',
            'measure_unit_id' => 'required|exists:measure_units,id',
            'disposal_en' => 'required|string|max:255',
            'disposal_sk' => 'required|string|max:255',
            'access_en' => 'required|string|max:255',
            'access_sk' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_sk' => 'nullable|string',
            'safety_items' => 'array', // Validate as an array
            'safety_items.*' => 'exists:safety_items,id', // Validate each ID exists
            'dangerous_properties' => 'array', // Validate as an array
            'dangerous_properties.*' => 'exists:dangerous_properties,id', // Validate each ID exists
        ]);

        // update chemical record
        $chemical->update($request->all());

        // attach dangerous properties
        $chemical->dangerousProperties()->sync($request->dangerous_properties);

        // attach safety items
        $chemical->safetyItems()->sync($request->safety_items);

        return redirect()->route('chemicals.index')->with('success', 'Chemical updated successfully.');
    }

    /**
     * deletes record from chemicals
     * @param Chemical $chemical
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Chemical $chemical): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);

        // delete record
        $chemical->delete();

        // redirect to chemicals index
        return redirect()->route('chemicals.index')->with('success', 'Chemical deleted successfully.');
    }
}
