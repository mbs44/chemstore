<!-- resources/views/chemicals/index.blade.php -->

@extends('layout')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-4">Chemicals</h1>

        <!-- Filter Form -->
        <form action="{{ route('chemicals.index') }}" method="GET">
            <div class="flex flex-wrap mb-4">
                <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                    <label for="chemical_name_en" class="block text-sm font-medium text-gray-700">Chemical Name (EN)</label>
                    <input type="text" id="chemical_name_en" name="chemical_name_en" value="{{ request()->input('chemical_name_en') }}" class="block w-full p-2 pl-10 text-sm text-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                    <label for="chemical_name_sk" class="block text-sm font-medium text-gray-700">Chemical Name (SK)</label>
                    <input type="text" id="chemical_name_sk" name="chemical_name_sk" value="{{ request()->input('chemical_name_sk') }}" class="block w-full p-2 pl-10 text-sm text-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                    <label for="chemical_formula" class="block text-sm font-medium text-gray-700">Chemical Formula</label>
                    <input type="text" id="chemical_formula" name="chemical_formula" value="{{ request()->input('chemical_formula') }}" class="block w-full p-2 pl-10 text-sm text-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" id="quantity" name="quantity" value="{{ request()->input('quantity') }}" class="block w-full p-2 pl-10 text-sm text-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                    <label for="measure_unit_id" class="block text-sm font-medium text-gray-700">Measure Unit</label>
                    <input type="text" id="measure_unit_id" name="measure_unit_id" value="{{ request()->input('measure_unit_id') }}" class="block w-full p-2 pl-10 text-sm text-gray-700 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Filter</button>
        </form>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-300 text-left">
                    <a href="{{ route('chemicals.index', ['sort' => 'chemical_name_en', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-gray-700 hover:text-blue-600">
                        Chemical Name (EN)
                        @if ($sortColumn === 'chemical_name_en')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="py-2 px-4 border-b border-gray-300 text-left">
                    <a href="{{ route('chemicals.index', ['sort' => 'chemical_name_sk', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-gray-700 hover:text-blue-600">
                        Chemical Name (EN)
                        @if ($sortColumn === 'chemical_name_sk')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="py-2 px-4 border-b border-gray-300 text-left">
                    <a href="{{ route('chemicals.index', ['sort' => 'chemical_formula', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-gray-700 hover:text-blue-600">
                        Chemical Formula
                        @if ($sortColumn === 'chemical_formula')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="py-2 px-4 border-b border-gray-300 text-left">
                    <a href="{{ route('chemicals.index', ['sort' => 'quantity', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-gray-700 hover:text-blue-600">
                        Quantity
                        @if ($sortColumn === 'quantity')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="py-2 px-4 border-b border-gray-300 text-left">
                    <a href="{{ route('chemicals.index', ['sort' => 'measure_unit_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-gray-700 hover:text-blue-600">
                        Measure Unit
                        @if ($sortColumn === 'measure_unit_id')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="py-2 px-4 border-b border-gray-300">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($chemicals as $chemical)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">{{ $chemical->chemical_name_en }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">{{ $chemical->chemical_name_sk }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">{{ $chemical->chemical_formula }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-right">{{ $chemical->quantity }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">{{ $chemical->measure_unit_id }}</td>

                    <td class="py-2 px-4 border-b border-gray-300">
                          <!-- You can add more action links here, like Edit or Delete -->
                        <a href="{{ route('chemicals.show', $chemical) }}" class="bg-blue-500 text-white px-2 py-1 rounded">View</a>
                        <a href="{{ route('chemicals.edit', $chemical) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                        <form action="{{ route('chemicals.destroy', $chemical) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="{{ route('chemicals.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-3 inline-block">Add New Chemical</a>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $chemicals->appends(['sort' => $sortColumn, 'direction' => $sortDirection])->links() }}
        </div>
    </div>
@endsection












