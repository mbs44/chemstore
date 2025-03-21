<!-- resources/views/experiments/index.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <h1 class="h1-screen">Users Search</h1>

        <!-- Filter Form -->
        <form action="{{ route('users.index') }}" method="GET">
            <div class="div-form">
                <div class="div-input">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-input" id="username" name="username"
                           value="{{ request()->input('username') }}">
                </div>

                <div class="div-full">
                    <button type="submit" class="button-submit">Filter</button>
                </div>
            </div>

        </form>

        <table class="table-result">
            <thead>
            <tr>
                <th class="table-col">Username</th>
                <th class="table-col">Admin</th>
                <th class="table-col">Teacher</th>
                <th class="table-col">Student</th>
                <th class="table-col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="table-cell text-left">{{ $user->username }}</td>
                    <td class="table-cell text-left">{{ $user->is_admin }}</td>
                    <td class="table-cell text-left">{{ $user->is_teacher }}</td>
                    <td class="table-cell text-left">{{ $user->is_student }}</td>
                    <td class="table-cell text-left">
                        <!-- You can add more action links here, like Edit or Delete -->

                    <a href="{{ route('users.edit', $user) }}"
                       class="bg-yellow-500 button-action">Edit</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->appends(['sort' => $sortColumn, 'direction' => $sortDirection])->links() }}
        </div>
    </div>
@endsection
