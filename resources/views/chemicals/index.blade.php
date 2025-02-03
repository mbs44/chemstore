<!-- resources/views/chemicals/index.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <h1 class="h1-screen">Chemicals</h1>

        <!-- Filter Form -->
        <form action="{{ route('chemicals.index') }}" method="GET">
            <div class="div-form">
                <div class="div-input">
                    <label for="chemical_name_en" class="form-label">Chemical Name (EN)</label>
                    <input type="text" class="form-input" id="chemical_name_en" name="chemical_name_en"
                           value="{{ request()->input('chemical_name_en') }}">
                </div>
                <div class="div-input">
                    <label for="chemical_name_sk" class="form-label">Chemical Name (SK)</label>
                    <input type="text" class="form-input" id="chemical_name_sk" name="chemical_name_sk"
                           value="{{ request()->input('chemical_name_sk') }}">
                </div>
                <div class="div-input">
                    <label for="chemical_formula" class="form-label">Chemical Formula</label>
                    <input type="text" class="form-input" id="chemical_formula" name="chemical_formula"
                           value="{{ request()->input('chemical_formula') }}">
                </div>
                <div class="div-input">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-input" id="quantity" name="quantity"
                           value="{{ request()->input('quantity') }}">
                </div>
                <div class="div-input">
                    <label for="measure_unit_id" class="form-label">Measure Unit</label>
                    <select id="measure_unit_id" name="measure_unit_id" class="form-input">
                        <option value="">Select a measure unit</option>
                        @foreach ($measureUnits as $unit)
                            <option value="{{ $unit->id }}" {{ request()->input('measure_unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="button-submit">Filter</button>
        </form>

        <table class=table-result>
            <thead>
            <tr>
                <th class="table-col">
                    <a href="{{ route('chemicals.index', ['sort' => 'chemical_name_en', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Chemical Name (EN)
                        @if ($sortColumn === 'chemical_name_en')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('chemicals.index', ['sort' => 'chemical_name_sk', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Chemical Name (EN)
                        @if ($sortColumn === 'chemical_name_sk')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('chemicals.index', ['sort' => 'chemical_formula', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Chemical Formula
                        @if ($sortColumn === 'chemical_formula')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('chemicals.index', ['sort' => 'quantity', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Quantity
                        @if ($sortColumn === 'quantity')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('chemicals.index', ['sort' => 'measure_unit_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Measure Unit
                        @if ($sortColumn === 'measure_unit_id')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($chemicals as $chemical)
                <tr>
                    <td class="table-cell text-left">{{ $chemical->chemical_name_en }}</td>
                    <td class="table-cell text-left">{{ $chemical->chemical_name_sk }}</td>
                    <td class="table-cell text-left">{{ $chemical->chemical_formula }}</td>
                    <td class="table-cell text-right">{{ $chemical->quantity }}</td>
                    <td class="table-cell text-left">{{ $chemical->measureUnit->name ?? 'N/A' }}</td>

                    <td class="table-cell">
                        <!-- You can add more action links here, like Edit or Delete -->
                        <a href="{{ route('chemicals.show', $chemical->id) }}" class="bg-blue-500 button-action">View</a>
                        <a href="{{ route('chemicals.edit', $chemical) }}" class="bg-yellow-500 button-action">Edit</a>
                        <form action="{{ route('chemicals.destroy', $chemical) }}" method="POST"
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
            {{ $chemicals->appends(['sort' => $sortColumn, 'direction' => $sortDirection])->links() }}
        </div>

        <a href="{{ route('chemicals.create') }}" class="button-submit">Add New Chemical</a>

    </div>
@endsection












