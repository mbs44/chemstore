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

class RequestActionsController extends Controller
{
    // Remove the specified request from storage
    public function approve(HttpRequest $request): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:requests,id', // Example validation
        ]);
        // Validate the request data
        $requestModel = RequestModel::findOrFail($request->id);
        $dbUser = User::query()->where('username', $request->user()->uid)->first();

        $requestModel->update([
            'state_id' => 3, // 'approved',
            'resolved_by' => $dbUser->id,
            'resolved_date' => Carbon::today()->toDateTimeString()
        ]);
        return redirect()->route('requests.index')->with('success', 'StudentRequest approved.');
    }

    // Remove the specified request from storage
    public function cancel(HttpRequest $request): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:requests,id', // Example validation
        ]);
        // Validate the request data
        $requestModel = RequestModel::findOrFail($request->id);
        $dbUser = User::query()->where('username', $request->user()->uid)->first();
        $requestModel->update([
            'state_id' => 2, // 'cancelled',
            'resolved_by' => $dbUser->id,
            'resolved_date' => Carbon::today()->toDateTimeString()
        ]);
        return redirect()->route('requests.index')->with('success', 'StudentRequest cancelled.');
    }

    // Remove the specified request from storage
    public function process(HttpRequest $request): RedirectResponse
    {
        $this->assertRoles( [ 'admin', 'teacher']);
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:requests,id', // Example validation
        ]);
        // Validate the request data
        $requestModel = RequestModel::findOrFail($request->id);
        $dbUser = User::query()->where('username', $request->user()->uid)->first();
        $requestModel->update([
            'state_id' => 4 ,// 'processed',
            'resolved_by' => $dbUser->id,
            'resolved_date' => Carbon::today()->toDateTimeString()
        ]);
        return redirect()->route('requests.index')->with('success', 'StudentRequest processed.');
    }
}
