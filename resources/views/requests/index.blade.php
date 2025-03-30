<!-- resources/views/chemicals/index.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        @if ( $allowApproval )
            <h1 class="h1-screen">{{$isEnglish?'Search Requests':'Vyhľadaj žiadosť'}}</h1>
        @else
            <h1 class="h1-screen">{{$isEnglish?'Search My Requests':'Vyhľadaj moju žiadosť'}}</h1>
        @endif

        <!-- Filter Form -->
        <form action="{{ route('requests.index') }}" method="GET">
            <div class="div-form">
                @if ( $allowApproval )
                <div class="div-input">
                    <label for="requested_by" class="form-label">{{$isEnglish?'Requested By':'Žiadateľ'}}</label>
                    <input type="text" class="form-input" id="requested_by" name="requested_by"
                           value="{{ request()->input('requested_by') }}">
                </div>
                @endif
                <div class="div-input">
                    <label for="state_id" class="form-label">{{$isEnglish?'State':'Stav'}}</label>
                    <select id="state_id" name="state_id" class="form-input">
                        <option value="">{{$isEnglish?'Select a state':'Zvoľ si stav'}}</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" {{ request()->input('state_id') == $state->id ? 'selected' : '' }}>
                                {{ $isEnglish?$state->name_en:$state->name_sk }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="div-input">
                    <label for="experiment_id" class="form-label">Experiment</label>
                    <select id="experiment_id" name="experiment_id" class="form-input">
                        <option value="">{{$isEnglish?'Select an experiment':'Zvoľ si experiment'}}</option>
                        @foreach ($experiments as $experiment)
                            <option value="{{ $experiment->id }}" {{ request()->input('experiment_id') == $experiment->id ? 'selected' : '' }}>
                                {{ $isEnglish?$experiment->name_en:$experiment->name_sk }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="div-input">
                    <label for="experiment_date_from" class="form-label">{{$isEnglish?'Experiment Date From':'Dátum experimentu od'}}</label>
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
                               placeholder="{{$isEnglish?'Select date':'Zvoľ si dátum'}}" value="{{ request()->input('experiment_date_from') }}">
                    </div>
                </div>

                <div class="div-input">
                    <label for="experiment_date_to" class="form-label">{{$isEnglish?'Experiment Date To':'Dátum experimentu do'}}</label>
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
                               placeholder="{{$isEnglish?'Select date':'Zvoľ si dátum'}}"  value="{{ request()->input('experiment_date_to') }}">
                    </div>
                </div>


                <div class="div-full">
                    <button type="submit" class="button-submit">{{$isEnglish?'Filter':'Vyhľadaj'}}</button>
                </div>
            </div>

        </form>

        <table class=table-result>
            <thead>
            <tr>
                <th class="table-col">
                    <a href="{{ route('requests.index', ['sort' => 'state_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        {{$isEnglish?'State':'Stav'}}
                        @if ($sortColumn === 'state_id')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('requests.index', ['sort' => 'requested_by', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        {{$isEnglish?'Requested By':'Žiadateľ'}}
                        @if ($sortColumn === 'requested_by')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('requests.index', ['sort' => 'experiment_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Experiment
                        @if ($sortColumn === 'experiment_id')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('requests.index', ['sort' => '$experiment_date', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        {{$isEnglish?'Experiment Date':'Dátum experimentu'}}
                        @if ($sortColumn === '$experiment_date')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">{{$isEnglish?'Actions':'Akcie'}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td class="table-cell text-left">{{ $isEnglish ? $request->state->name_en : $request->state->name_sk }}</td>
                    <td class="table-cell text-left">{{ $request->requestedBy->username }}</td>
                    <td class="table-cell text-left">{{ $isEnglish ? $request->experiment->name_en :  $request->experiment->name_sk }}</td>
                    <td class="table-cell text-left">{{ $request->localDate($request->experiment_date)}}</td>

                    <td class="table-cell">
                        <!-- You can add more action links here, like Edit or Delete -->
                        <a href="{{ route('requests.show', $request->id) }}" class="bg-blue-500 button-action">{{$isEnglish?'View':'Zobraziť'}}</a>
                        @if ( $request->state_id == 1 || $allowApproval )
                            <a href="{{ route('requests.edit', $request) }}" class="bg-yellow-500 button-action">{{$isEnglish?'Edit':'Zmeniť'}}</a>
                        @endif
                        @if ( $allowApproval )
                            @if ( $request->state_id == 1 || $request->state_id == 2 ) <!-- initial -->
                                <form action="{{ route('request.approve') }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $request->id }}">
                                    <button type="submit" class="bg-green-700 button-action">{{$isEnglish?'Approve':'Schváliť'}}</button>
                                </form>
                            @endif
                            @if ( $request->state_id == 3 )  <!-- approved -->
                                <form action="{{ route('request.process') }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $request->id }}">
                                    <button type="submit" class="bg-blue-500 button-action">{{$isEnglish?'Issue':'Vydať'}}</button>
                                </form>
                            @endif
                            @if ( $request->state_id == 3 || $request->state_id == 1 || $request->state_id == 4) <!-- approved or initial -->
                                <form action="{{ route('request.cancel') }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $request->id }}">
                                    <button type="submit" class="bg-red-500 button-action">{{$isEnglish?'Cancel':'Zrušiť'}}</button>
                                </form>
                            @endif
                        @endif
                        @if ( $request->state_id == 2 )  <!-- initial -->
                            <form action="{{ route('requests.destroy', $request) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 button-action">{{$isEnglish?'Delete':'Zmazať'}}</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="mt-4">
            {{ $requests->appends(['sort' => $sortColumn, 'direction' => $sortDirection])->links() }}
        </div>

        <a href="{{ route('requests.create') }}" class="button-submit">{{$isEnglish?'Add New Request':'Pridať novú žiadosť'}}</a>

    </div>
@endsection
