<!-- resources/views/chemicals/edit.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <h1 class="h1-screen">Request for Chemicals</h1>

        <form action="{{ route('requests.update', $request->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="div-form">

                <div class="div-input">
                    <label for="experiment_id" class="form-label">Experiment</label>
                    <select id="experiment_id" name="experiment_id" class="form-input" required>
                        <option value="">Select an experiment</option>
                        @foreach ($experiments as $item)
                            <option value="{{ $item->id }}" {{ old('experiment_id', $request->experiment_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->name_en }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="div-input">
                    <label for="experiment_date" class="form-label">Experiment Date</label>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="experiment_date" name="experiment_date" required datepicker datepicker-format="dd.mm.yyyy" datepicker-autohide type="text"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Select date" value="{{ old('experiment_date',  $request->localDate($request->experiment_date)) }}">
                    </div>
                </div>

                <div class="div-full">
                    <h2 class="text-lg font-semibold mb-2">Chemical List</h2>
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead>
                        <tr>
                            <th class="table-col">Chemical</th>
                            <th class="table-col">Quantity</th>
                            <th class="table-col">Action</th>
                        </tr>
                        </thead>
                        <tbody id="chemicals">
                        @foreach($request->chemicals as $chemical)
                        <tr class="chemical-entry">
                            <td class="table-cell">
                                <select name="chemicals[{{$loop->index }}][chemical_id]"
                                        class="form-input"
                                        required>
                                    <option value="{{ $chemical->id }}">Select a chemical</option>
                                    @foreach($chemicals as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('chemicals[' . $loop->index . '][chemical_id]' , $chemical->id) == $item->id ? 'selected' : '' }}
                                        >{{ $item->chemical_name_en }} ({{ $item->chemical_formula }}) in {{ $item->measureUnit->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="table-cell">
                                <input type="number" name="chemicals[{{$loop->index }}][quantity]"
                                       value="{{ old('chemicals[' . $loop->index . '][quantity]', $chemical->pivot->quantity )}}"
                                       class="form-input" required>
                            </td>
                            <td class="table-cell">
                                @if ( $loop->index > 0)
                                    <button type="button" class="delete-chemical text-red-500 hover:underline">Delete</button>
                                @else
                                    <button type="button" class="delete-chemical text-gray-500">No action</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="div-full">
                    <button type="button" id="add-chemical"
                            class="button-add-item">
                        Add Another Chemical
                    </button>
                </div>
                <div class="div-full">
                    <label for="note" class="form-label">Note</label>
                    <textarea class="form-textarea" id="note"
                              name="note">{{ old('note', $request->note) }}</textarea>
                </div>
                @if ( $allowApproval )
                <div class="div-full">
                    <label for="teacher_note" class="form-label">Teacher Note</label>
                    <textarea class="form-textarea" id="teacher_note"
                              name="teacher_note">{{ old('teacher_note', $request->teacher_note) }}</textarea>
                </div>
                @endif

            </div>
            @if ( $allowApproval || $request->state_id == 1 )
                <button type="submit" class="button-submit">Update Request</button>
            @endif
            <a href="{{ route('requests.index') }}" class="button-cancel">Close</a>

        </form>

    </div>

    <script>
        document.getElementById('add-chemical').addEventListener('click', function() {
            const chemicalsTable = document.getElementById('chemicals');
            const chemicalCount = chemicalsTable.getElementsByClassName('chemical-entry').length;

            const newChemicalEntry = document.createElement('tr');
            newChemicalEntry.classList.add('chemical-entry');

            newChemicalEntry.innerHTML = `
            <td class="table-cell">
                <select name="chemicals[${chemicalCount}][chemical_id]"
                        class="form-input"
                        required>
                    <option value="">Select a chemical</option>
                    @foreach($chemicals as $chemical)
            <option value="{{ $chemical->id }}">{{ $chemical->chemical_name_en }} ({{ $chemical->chemical_formula }}) in {{ $chemical->measureUnit->name }}</option>
                    @endforeach
            </select>
        </td>
        <td class="table-cell">
            <input type="number" name="chemicals[${chemicalCount}][quantity]"
                       class="form-input"
                       required>
            </td>
            <td class="table-cell">
                <button type="button" class="delete-chemical text-red-500 hover:underline">Delete</button>
            </td>
        `;

            chemicalsTable.appendChild(newChemicalEntry);

            // Add event listener for the delete button
            newChemicalEntry.querySelector('.delete-chemical').addEventListener('click', function() {
                chemicalsTable.removeChild(newChemicalEntry);
            });
        });

        // Add event listener for the initial delete button
        document.querySelectorAll('.delete-chemical').forEach(button => {
            button.addEventListener('click', function() {
                const chemicalEntry = button.closest('.chemical-entry');
                chemicalsTable.removeChild(chemicalEntry);
            });
        });
    </script>
@endsection
