<!-- resources/views/chemicals/index.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <h1 class="h1-screen">Search Requests</h1>

        <!-- Filter Form -->
        <form action="{{ route('requests.index') }}" method="GET">
            <div class="div-form">
                <div class="div-input">
                    <label for="requested_by" class="form-label">Requested By</label>
                    <input type="text" class="form-input" id="requested_by" name="requested_by"
                           value="{{ request()->input('requested_by') }}">
                </div>

                <div class="div-input">
                    <label for="state_id" class="form-label">State</label>
                    <select id="state_id" name="state_id" class="form-input">
                        <option value="">Select a state</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" {{ request()->input('state_id') == $state->id ? 'selected' : '' }}>
                                {{ $state->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="div-input">
                    <label for="experiment_id" class="form-label">Experiment</label>
                    <select id="experiment_id" name="experiment_id" class="form-input">
                        <option value="">Select an experiment</option>
                        @foreach ($experiments as $experiment)
                            <option value="{{ $experiment->id }}" {{ request()->input('experiment_id') == $experiment->id ? 'selected' : '' }}>
                                {{ $experiment->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="div-input">
                    <label for="experiment_date_from" class="form-label">Experiment Date From</label>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="experiment_date_from" name="experiment_date_from" datepicker datepicker-format="dd.mm.yyyy" datepicker-autohide type="text"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Select date" value="{{ request()->input('experiment_date_from') }}">
                    </div>
                </div>

                <div class="div-input">
                    <label for="experiment_date_to" class="form-label">Experiment Date To</label>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="experiment_date_to" name="experiment_date_to" datepicker datepicker-format="dd.mm.yyyy" datepicker-autohide type="text"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Select date"  value="{{ request()->input('experiment_date_to') }}">
                    </div>
                </div>


                <div class="div-full">
                    <button type="submit" class="button-submit">Filter</button>
                </div>
            </div>

        </form>

        <table class=table-result>
            <thead>
            <tr>
                <th class="table-col">
                    <a href="{{ route('requests.index', ['sort' => 'state_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        State (EN)
                        @if ($sortColumn === 'state_id')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('requests.index', ['sort' => 'requested_by', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Requested by
                        @if ($sortColumn === 'requested_by')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('requests.index', ['sort' => 'experiment_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Experiment (EN)
                        @if ($sortColumn === 'experiment_id')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('requests.index', ['sort' => '$experiment_date', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Experiment Date
                        @if ($sortColumn === '$experiment_date')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td class="table-cell text-left">{{ $request->state->name_en }}</td>
                    <td class="table-cell text-left">{{ $request->requestedBy->username }}</td>
                    <td class="table-cell text-left">{{ $request->experiment->name_en }}</td>
                    <td class="table-cell text-left">{{ $request->localDate($request->experiment_date)}}</td>

                    <td class="table-cell">
                        <!-- You can add more action links here, like Edit or Delete -->
                        <a href="{{ route('requests.show', $request->id) }}" class="bg-blue-500 button-action">View</a>
                        <a href="{{ route('requests.edit', $request) }}" class="bg-yellow-500 button-action">Edit</a>
                        <form action="{{ route('requests.destroy', $request) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 button-action">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="mt-4">
            {{ $requests->appends(['sort' => $sortColumn, 'direction' => $sortDirection])->links() }}
        </div>

        <a href="{{ route('requests.create') }}" class="button-submit">Add New Request</a>

    </div>
@endsection
