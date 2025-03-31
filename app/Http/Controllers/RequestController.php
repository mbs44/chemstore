<?php
// app/Http/Controllers/RequestController.php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Models\StudentRequest;

// Rename to avoid conflict with the class name
use App\Models\Chemical;
use App\Models\MeasureUnit;

// Assuming you have a MeasureUnit model
use App\Models\State;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RequestController extends Controller
{
    // Display a listing of the requests with search functionality
    public function index(HttpRequest $request): View
    {
        // Get the filter parameters from the request
        $stateId = $request->input('state_id');
        $requestedBy = $request->input('requested_by');
        $experimentId = $request->input('experiment_id');
        $experimentDateFrom = $request->input('experiment_date_from');
        $experimentDateTo = $request->input('experiment_date_to');

        // Start the query
        $query = StudentRequest::query();

        // Apply the filter parameters to the database query
        if ($stateId) {
            $query->where('state_id', $stateId);
        }


        $allowApproval = $this->checkRoles([ 'admin', 'teacher']);

        if ( $allowApproval) {
            if ($requestedBy) {
                $query->whereHas('requestedBy', function ($query) use ($requestedBy) {
                    $query->where('username', 'like', '%' . $requestedBy . '%');
                });

            }
        } else {
            $dbUser = User::query()->where('username', $request->user()->uid)->first();
            $query->where('requested_by',$dbUser->id );
        }

        // Check if the date was created successfully

        // Format the date to ISO format (yyyy-mm-dd)

        if ($experimentDateFrom) {
            $dateTime = DateTime::createFromFormat('d.m.Y', $experimentDateFrom);
            if ($dateTime) {
                // Format the date to ISO format (yyyy-mm-dd)
                $isoDate = $dateTime->format('Y-m-d');
                $query->where('experiment_date', '>',  $isoDate );
            }
        }

        if ($experimentDateTo) {
            $dateTime = DateTime::createFromFormat('d.m.Y', $experimentDateTo);
            if ($dateTime) {
                // Format the date to ISO format (yyyy-mm-dd)
                $isoDate = $dateTime->format('Y-m-d');
                $query->where('experiment_date', '<',  $isoDate );
            }
        }

        if ($experimentId) {
            $query->where('experiment_id', $experimentId);
        }

        // Get the sort column and direction from the request
        $sortColumn = $request->get('sort', 'experiment_date'); // Default sort by chemical name
        $sortDirection = $request->get('direction', 'asc'); // Default direction

        // Validate the sort column and direction
        $validColumns = ['experiment_date', 'requested_by', 'state_id', 'experiment_id',
            'created_at', 'updated_at'];
        if (!in_array($sortColumn, $validColumns)) {
            $sortColumn = 'experiment_date';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Retrieve chemicals with sorting and pagination
        $requests = $query->orderBy($sortColumn, $sortDirection)->paginate(25);
        $experiments = Experiment::all();
        $states = State::all();


        return view('requests.index', compact('requests', 'experiments', 'states',
            'sortColumn', 'sortDirection', 'allowApproval'));
    }

    // Show the form for creating a new request
    public function create(): View
    {
        $chemicals = Chemical::all();
        $measureUnits = MeasureUnit::all(); // Assuming you have a MeasureUnit model
        $experiments = Experiment::all();

        return view('requests.create', compact('chemicals',
            'measureUnits', 'experiments'));
    }

    // Store a newly created request in storage
    public function store(HttpRequest $request): RedirectResponse
    {
        $request->validate([
            'experiment_id' => 'required|exists:experiments,id',
            'experiment_date' => 'required|date',
            'note' => 'nullable|string',
            'chemicals' => 'required|array',
            'chemicals.*.chemical_id' => 'required|exists:chemicals,id',
            'chemicals.*.quantity' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/|min:0',
        ]);

        $dbUser = User::query()->where('username', $request->user()->uid)->first();

// Input date in dd.mm.yyyy format
        $dateString = $request->experiment_date;

// Create a DateTime object from the given format
        $dateTime = DateTime::createFromFormat('d.m.Y', $dateString);

// Check if the date was created successfully
        if ($dateTime) {
            // Format the date to ISO format (yyyy-mm-dd)
            $isoDate = $dateTime->format('Y-m-d');
        } else {
            return back()->withErrors(['message' => 'Invalid date format.'])->withInput();
        }
        // Start a database transaction

        DB::beginTransaction();

        try {
            $newRequest = StudentRequest::create([
                'state_id' => 1, //Initial
                'requested_by' => $dbUser->id, //TODO: here must be user id from DB
                'experiment_id' => $request->experiment_id,
                'experiment_date' => $isoDate,
                'note' => $request->note
            ]);

            foreach ($request->chemicals as $chemical) {
                $dbChemical = Chemical::query()->find($chemical['chemical_id']);
                $newRequest->chemicals()->attach($chemical['chemical_id'], [
                    'quantity' => $chemical['quantity'],
                    'measure_unit_id' => $dbChemical['measure_unit_id'],
                ]);
            }
            // Commit the transaction

            DB::commit();
            return redirect()->route('requests.index')->with('success', 'StudentRequest created successfully.');
        } catch (Exception $e) {

            // Rollback the transaction if something failed
            DB::rollBack();
            return back()->withErrors(['message' => 'Failed to create request: ' . $e->getMessage()]);

        }
    }

    // Display the specified request
    public function show($id): View
    {
        $request = StudentRequest::with([ 'chemicals'])->findOrFail($id);
        $chemicals = Chemical::all();
        $measureUnits = MeasureUnit::all(); // Assuming you have a MeasureUnit model
        $experiments = Experiment::all();
        $states = State::all();
        $allowApproval = $this->checkRoles([ 'admin', 'teacher']);
        return view('requests.show', compact('request',
        'chemicals', 'measureUnits', 'experiments', 'states', 'allowApproval'));
    }

    // Show the form for editing the specified request
    public function edit(StudentRequest $request): View
    {
        $chemicals = Chemical::all();
        $measureUnits = MeasureUnit::all(); // Assuming you have a MeasureUnit model
        $experiments = Experiment::all();

        $allowApproval = $this->checkRoles([ 'admin', 'teacher']);
        return view('requests.edit', compact('request', 'chemicals',
            'measureUnits', 'experiments', 'allowApproval'));
    }

    // Update the specified request in storage
    public function update(HttpRequest $request, $id): RedirectResponse
    {
        $studentRequest = StudentRequest::with([ 'chemicals'])->findOrFail($id);
        $allowApproval = $this->checkRoles([ 'admin', 'teacher']);

        if ( !$allowApproval) {
            $dbUser = User::query()->where('username', $request->user()->uid)->first();
            if ( $studentRequest->state_id != 1 ||
                $request->teacher_note ||
                $dbUser->id != $studentRequest->requestedBy) {
                throw new AuthorizationException('You do not have permission for this action.');
            }
        }

        $request->validate([
            'experiment_id' => 'required|exists:experiments,id',
            'experiment_date' => 'required|date',
            'note' => 'nullable|string',
            'teacher_note' => 'nullable|string',
            'chemicals' => 'required|array',
            'chemicals.*.chemical_id' => 'required|exists:chemicals,id',
            'chemicals.*.quantity' => 'required|regex:/^\d{1,8}(\.\d{1,2})?$/|min:0',
        ]);
        // Input date in dd.mm.yyyy format
        $dateString = $request->experiment_date;

// Create a DateTime object from the given format
        $dateTime = DateTime::createFromFormat('d.m.Y', $dateString);

// Check if the date was created successfully
        if ($dateTime) {
            // Format the date to ISO format (yyyy-mm-dd)
            $isoDate = $dateTime->format('Y-m-d');
        } else {
            return back()->withErrors(['message' => 'Invalid date format.'])->withInput();
        }

        DB::beginTransaction();

        try {
            $studentRequest->update([
                'experiment_id' => $request->experiment_id,
                'experiment_date' => $isoDate,
                'note' => $request->note,
                'teacher_note' => $request->teacher_note,
            ]);

            // Sync chemicals
            $studentRequest->chemicals()->detach();
            foreach ($request->chemicals as $chemical) {
                $dbChemical = Chemical::query()->find($chemical['chemical_id']);
                $studentRequest->chemicals()->attach($chemical['chemical_id'], [
                    'quantity' => $chemical['quantity'],
                    'measure_unit_id' => $dbChemical['measure_unit_id'],
                ]);
            }
            DB::commit();
            return redirect()->route('requests.index')->with('success', 'StudentRequest updated successfully.');
        } catch (Exception $e) {
            // Rollback the transaction if something failed
            DB::rollBack();
            return back()->withErrors(['message' => 'Failed to update request: ' . $e->getMessage()]);

        }
    }

    // Remove the specified request from storage
    public function destroy(StudentRequest $studentRequest): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);
        DB::beginTransaction();

        try {
            $studentRequest->chemicals()->detach();
            $studentRequest->delete();

            DB::commit();
            return redirect()->route('requests.index')->with('success', 'StudentRequest deleted successfully.');
        } catch (Exception $e) {
            // Rollback the transaction if something failed
            DB::rollBack();
            return back()->withErrors(['message' => 'Failed to delete request: ' . $e->getMessage()]);
        }
    }

}
