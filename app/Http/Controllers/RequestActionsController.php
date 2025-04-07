<?php
// app/Http/Controllers/RequestController.php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Models\StudentRequest as RequestModel;

// Rename to avoid conflict with the class name
use App\Models\Chemical;
use App\Models\MeasureUnit;

// Assuming you have a MeasureUnit model
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Contains actions for student request state diagram
 */
class RequestActionsController extends Controller
{
    /**
     * Approves student request
     * @param HttpRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function approve(HttpRequest $request): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:student_requests,id', // Example validation
        ]);
        // Load the request by id
        $requestModel = RequestModel::findOrFail($request->id);

        // load the current user from users table
        $dbUser = User::query()->where('username', $request->user()->getUserName() )->first();

        // update state
        $requestModel->update([
            'state_id' => 3, // 'approved',
            'resolved_by' => $dbUser->id, // current teacher id
            'resolved_date' => Carbon::today()->toDateTimeString() // current date
        ]);
        return redirect()->route('requests.index')->with('success', 'StudentRequest approved.');
    }

    /**
     * Cancels student request
     * @param HttpRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function cancel(HttpRequest $request): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:student_requests,id', // Example validation
        ]);
        // Load the request by id
        $requestModel = RequestModel::findOrFail($request->id);
        // load the current user from users table
        $dbUser = User::query()->where('username', $request->user()->getUserName())->first();
        $requestModel->update([
            'state_id' => 2, // 'cancelled',
            'resolved_by' => $dbUser->id, // current teacher id
            'resolved_date' => Carbon::today()->toDateTimeString() // current date
        ]);
        return redirect()->route('requests.index')->with('success', 'StudentRequest cancelled.');
    }

    /**
     * Process request / issue chemicals
     * @param HttpRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function process(HttpRequest $request): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:student_requests,id', // Example validation
        ]);
        // Load the request by id
        $requestModel = RequestModel::findOrFail($request->id);
        // load the current user from users table
        $dbUser = User::query()->where('username', $request->user()->getUserName())->first();
        $requestModel->update([
            'state_id' => 4 ,// 'processed',
            'resolved_by' => $dbUser->id, // current teacher id
            'resolved_date' => Carbon::today()->toDateTimeString() // current date
        ]);
        return redirect()->route('requests.index')->with('success', 'StudentRequest processed.');
    }
}
