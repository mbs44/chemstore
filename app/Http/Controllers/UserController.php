<?php

namespace App\Http\Controllers;

use App\Models\Chemical;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public static function isAdmin() : bool
    {
        return Controller::userInRole('admin');
    }

    // Display a listing of the experiments
    public function index(Request $request): View
    {
        $this->assertRoles( [ 'admin']);

        $query = User::query();
        $username = $request->input('username');

        // Apply the filter parameters to the database query
        if ($username) {
            $query->where('username', 'like', '%' . $username . '%');
        }

        // Get the sort column and direction from the request
        $sortColumn = $request->get('sort', 'username'); // Default sort by chemical name
        $sortDirection = $request->get('direction', 'asc'); // Default direction

        // Validate the sort column and direction
        $validColumns = ['username', 'name_sk'];
        if (!in_array($sortColumn, $validColumns)) {
            $sortColumn = 'username';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Retrieve chemicals with sorting and pagination
        $users = $query->orderBy($sortColumn, $sortDirection)->paginate(25);

        return view('users.index',
            compact('users', 'sortColumn', 'sortDirection'));
    }

    // Show the form for editing the specified experiment

    /**
     * @throws AuthorizationException
     */
    public function edit(User $user): View
    {
        $this->assertRoles( [ 'admin']);
        return view('users.edit', compact('user'));
    }

    // Update the specified experiment in storage

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $this->assertRoles( [ 'admin']);

        $request->validate([
            'is_admin' => 'required|in:0,1', // Ensure the value is either 0 or 1
            'is_teacher' => 'required|in:0,1', // Ensure the value is either 0 or 1
            'is_student' => 'required|in:0,1', // Ensure the value is either 0 or 1

        ]);

        $user->update($request->all()); // Update the experiment
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

}
