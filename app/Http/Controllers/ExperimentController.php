<?php

namespace App\Http\Controllers;

use App\Models\Chemical;
use App\Models\Experiment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ExperimentController extends Controller
{
    // Display a listing of the experiments
    public function index(Request $request): View
    {
        $query = Experiment::query();
        $nameEn = $request->input('name_en');
        $nameSk = $request->input('name_sk');
        // Apply the filter parameters to the database query
        if ($nameEn) {
            $query->where('name_en', 'like', '%' . $nameEn . '%');
        }
        if ($nameSk) {
            $query->where('name_sk', 'like', '%' . $nameEn . '%');
        }

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

        // Retrieve chemicals with sorting and pagination
        $experiments = $query->orderBy($sortColumn, $sortDirection)->paginate(25);
        $chemicals = Chemical::all();
        return view('experiments.index',
            compact('experiments', 'sortColumn', 'sortDirection', 'chemicals', 'selectedChemicals'));
    }

    // Show the form for creating a new experiment
    public function create(): View
    {
        $userRoles = session('user_roles', []);
        if (!in_array('admin', $userRoles, true) &&
            !in_array('teacher', $userRoles, true)) {
            throw new AuthorizationException('You do not have permission for this action.');
        }

        $chemicals = Chemical::all();
        return view('experiments.create', compact('chemicals'));
    }

    // Store a newly created experiment in storage
    public function store(Request $request): RedirectResponse
    {
        $userRoles = session('user_roles', []);
        if (!in_array('admin', $userRoles, true) &&
            !in_array('teacher', $userRoles, true)) {
            throw new AuthorizationException('You do not have permission for this action.');
        }

        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_sk' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_sk' => 'nullable|string',
            'chemicals' => 'array', // Validate as an array
            'chemicals.*' => 'exists:chemicals,id', // Validate each ID exists
        ]);

        $experiment = Experiment::create($request->all()); // Create a new experiment

        if ($request->has('chemicals')) {
            $experiment->chemicals()->attach($request->chemicals);
        }

        return redirect()->route('experiments.index')->with('success', 'Experiment created successfully.');
    }

    // Display the specified experiment
    public function show($id): View
    {
        $experiment = Experiment::with( 'chemicals' )->findOrFail($id); // Find the experiment by ID
        return view('experiments.show', compact('experiment'));
    }

    // Show the form for editing the specified experiment
    public function edit(Experiment $experiment): View
    {
        $userRoles = session('user_roles', []);
        if (!in_array('admin', $userRoles, true) &&
            !in_array('teacher', $userRoles, true)) {
            throw new AuthorizationException('You do not have permission for this action.');
        }

        $chemicals = Chemical::all();
        $selectedChemicals = $experiment->chemicals->pluck('id')->toArray();// Find the experiment by ID
        return view('experiments.edit', compact('experiment', 'chemicals', 'selectedChemicals'));
    }

    // Update the specified experiment in storage
    public function update(Request $request, Experiment $experiment): RedirectResponse
    {
        $userRoles = session('user_roles', []);
        if (!in_array('admin', $userRoles, true) &&
            !in_array('teacher', $userRoles, true)) {
            throw new AuthorizationException('You do not have permission for this action.');
        }

        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_sk' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_sk' => 'nullable|string',
            'chemicals' => 'array', // Validate as an array
            'chemicals.*' => 'exists:chemicals,id', // Validate each ID exists
        ]);

        $experiment->update($request->all()); // Update the experiment
        $experiment->chemicals()->sync($request->chemicals);
        return redirect()->route('experiments.index')->with('success', 'Experiment updated successfully.');
    }

    // Remove the specified experiment from storage
    public function destroy(Experiment $experiment): RedirectResponse
    {
        $userRoles = session('user_roles', []);
        if (!in_array('admin', $userRoles, true) &&
            !in_array('teacher', $userRoles, true)) {
            throw new AuthorizationException('You do not have permission for this action.');
        }

        $experiment->delete(); // Delete the experiment
        return redirect()->route('experiments.index')->with('success', 'Experiment deleted successfully.');
    }
}
