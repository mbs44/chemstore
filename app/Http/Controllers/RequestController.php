<?php
// app/Http/Controllers/RequestController.php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Models\Request as RequestModel; // Rename to avoid conflict with the class name
use App\Models\Chemical;
use App\Models\MeasureUnit; // Assuming you have a MeasureUnit model
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\View\View;

class RequestController extends Controller
{
    // Display a listing of the requests with search functionality
    public function index(HttpRequest $request):View
    {
        $searchTerm = $request->input('search');
        $chemicalId = $request->input('chemical_id');

        $query = RequestModel::with('chemicals', 'requestedBy', 'resolvedBy');

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('experiment_date', 'like', "%{$searchTerm}%")
                    ->orWhere('note', 'like', "%{$searchTerm}%")
                    ->orWhere('reject_reason', 'like', "%{$searchTerm}%")
                    ->orWhereHas('requestedBy', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('resolvedBy', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        if ($chemicalId) {
            $query->whereHas('chemicals', function ($q) use ($chemicalId) {
                $q->where('chemical_id', $chemicalId);
            });
        }

        $requests = $query->paginate(10);
        $chemicals = Chemical::all();

        return view('requests.index', compact('requests', 'chemicals', 'searchTerm', 'chemicalId'));
    }

    // Show the form for creating a new request
    public function create():View
    {
        $chemicals = Chemical::all();
        $measureUnits = MeasureUnit::all(); // Assuming you have a MeasureUnit model
        $experiments = Experiment::all();
        return view('requests.create', compact('chemicals', 'measureUnits', 'experiments'));
    }

    // Store a newly created request in storage
    public function store(HttpRequest $request): RedirectResponse
    {
        $request->validate([
            'experiment_id' => 'required|exists:experiments,id',
            'experiment_date' => 'required|date|after:today',
            'note' => 'nullable|string',
            'chemicals' => 'required|array',
            'chemicals.*.chemical_id' => 'required|exists:chemicals,id',
            'chemicals.*.quantity' =>  'required|regex:/^\d{1,8}(\.\d{1,2})?$/|min:0',
        ]);

        $newRequest = RequestModel::create([
            'state_id' => 1, //Initial
            'requested_by' => $request->user()->id, //TODO: here must be user id from DB
            'experiment_id' => $request->experiment_id,
            'experiment_date' => $request->experiment_date,
            'note' => $request->note
        ]);

        foreach ($request->chemicals as $chemical) {
            $newRequest->chemicals()->attach($chemical['chemical_id'], [
                'quantity' => $chemical['quantity'],
            ]);
        }

        return redirect()->route('requests.index')->with('success', 'Request created successfully.');
    }

    // Display the specified request
    public function show(RequestModel $request):View
    {
        return view('requests.show', compact('request'));
    }

    // Show the form for editing the specified request
    public function edit(RequestModel $request):View
    {
        $chemicals = Chemical::all();
        $measureUnits = MeasureUnit::all(); // Assuming you have a MeasureUnit model
        return view('requests.edit', compact('request', 'chemicals', 'measureUnits'));
    }

    // Update the specified request in storage
    public function update(HttpRequest $request, RequestModel $requestModel): RedirectResponse
    {
        $request->validate([
            'experiment_id' => 'required|exists:experiments,id',
            'experiment_date' => 'required|date|after:today',
            'note' => 'nullable|string',
            'chemicals' => 'required|array',
            'chemicals.*.chemical_id' => 'required|exists:chemicals,id',
            'chemicals.*.quantity' =>  'required|regex:/^\d{1,8}(\.\d{1,2})?$/|min:0',
        ]);

        $requestModel->update([
            'experiment_id' => $request->experiment_id,
            'experiment_date' => $request->experiment_date,
            'note' => $request->note,
        ]);

        // Sync chemicals
        $requestModel->chemicals()->detach();
        foreach ($request->chemicals as $chemical) {
            $requestModel->chemicals()->attach($chemical['chemical_id'], [
                'quantity' => $chemical['quantity'],
            ]);
        }

        return redirect()->route('requests.index')->with('success', 'Request updated successfully.');
    }

    // Remove the specified request from storage
    public function destroy(RequestModel $requestModel): RedirectResponse
    {
        $requestModel->delete();
        return redirect()->route('requests.index')->with('success', 'Request deleted successfully.');
    }
}
