<?php

namespace App\Http\Controllers;

use App\Models\Chemical;
use App\Models\Experiment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Implements CRUD for experiments
 */
class ExperimentController extends Controller
{
    /**
     * implements search logic and returns result to index blade
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Get the filter parameters from the request
        $nameEn = $request->input('name_en');
        $nameSk = $request->input('name_sk');

        // Start query builder
        $query = Experiment::query();

        // Apply the filter parameters to the database query using predefined operators
        if ($nameEn) {
            $query->where('name_en', 'like', '%' . $nameEn . '%');
        }
        if ($nameSk) {
            $query->where('name_sk', 'like', '%' . $nameEn . '%');
        }

        // requested chemicals are searched by joining chemical_experiment
        if ($request->has('chemicals')) {
            $selectedChemicals = $request->input('chemicals');
            $query->whereHas('chemicals', function ($query) use ($selectedChemicals) {
                $query->whereIn('chemical_id', $selectedChemicals);
            });
        } else
            $selectedChemicals = [];

        // Get the sort column and direction from the request
        $sortColumn = $request->get('sort', 'name_en'); // Default sort by chemical name
        $sortDirection = $request->get('direction', 'asc'); // Default direction

        // Validate the sort column and direction
        $validColumns = ['name_en', 'name_sk'];
        if (!in_array($sortColumn, $validColumns)) {
            $sortColumn = 'chemical_en';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Retrieve experiments with sorting and pagination
        $experiments = $query->orderBy($sortColumn, $sortDirection)->paginate(25);

        // Load all chemicals values as a code table
        $chemicals = Chemical::all();
        // security flag
        $allowEdit = $this->checkRoles([ 'admin', 'teacher']);
        return view('experiments.index',
            compact('experiments', 'sortColumn', 'sortDirection',
                'chemicals', 'selectedChemicals', 'allowEdit'));
    }

    /**
     * Show the form for creating a new experiment
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->assertRoles( [ 'admin', 'teacher']);

        // Load all chemicals values as a code table
        $chemicals = Chemical::all();
        return view('experiments.create', compact('chemicals'));
    }



    /**
     * Store a newly created experiment in database
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);

        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_sk' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_sk' => 'nullable|string',
            'chemicals' => 'array', // Validate as an array
            'chemicals.*' => 'exists:chemicals,id', // Validate each ID exists
        ]);

        $experiment = Experiment::create($request->all()); // Create a new experiment

        // attach required chemicals
        if ($request->has('chemicals')) {
            $experiment->chemicals()->attach($request->chemicals);
        }

        return redirect()->route('experiments.index')->with('success', 'Experiment created successfully.');
    }

    /**
     * call show blade for the specified experiment
     * @param $id
     * @return View
     */
    public function show($id): View
    {
        // load experiment detail with required chemicals
        $experiment = Experiment::with( 'chemicals' )->findOrFail($id); // Find the experiment by ID
        return view('experiments.show', compact('experiment'));
    }

    /**
     * Show the form for editing the specified experiment
     * @param Experiment $experiment
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Experiment $experiment): View
    {
        $this->assertRoles( [ 'admin', 'teacher']);

        // load chemicals as code table
        $chemicals = Chemical::all();
        // attach required chemicals
        $selectedChemicals = $experiment->chemicals->pluck('id')->toArray();// Find the experiment by ID
        return view('experiments.edit', compact('experiment', 'chemicals', 'selectedChemicals'));
    }

    /**
     * Update the specified experiment in storage
     * @param Request $request
     * @param Experiment $experiment
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Experiment $experiment): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);

        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_sk' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_sk' => 'nullable|string',
            'chemicals' => 'array', // Validate as an array
            'chemicals.*' => 'exists:chemicals,id', // Validate each ID exists
        ]);

        // updates experiment record
        $experiment->update($request->all());

        // attach required chemicals
        $experiment->chemicals()->sync($request->chemicals);
        return redirect()->route('experiments.index')->with('success', 'Experiment updated successfully.');
    }

    /**
     * Remove the specified experiment from database
     * @param Experiment $experiment
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Experiment $experiment): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);

        $experiment->delete(); // Delete the experiment
        return redirect()->route('experiments.index')->with('success', 'Experiment deleted successfully.');
    }
}
