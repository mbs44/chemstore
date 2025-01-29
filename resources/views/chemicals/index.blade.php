<!-- resources/views/chemicals/index.blade.php -->

@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Chemicals</h1>
    <a href="{{ route('chemicals.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-3 inline-block">Add New Chemical</a>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
        <tr>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Formula</th>
            <th class="py-2 px-4 border-b">Description</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($chemicals as $chemical)
            <tr>
                <td class="py-2 px-4 border-b">{{ $chemical->name }}</td>
                <td class="py-2 px-4 border-b">{{ $chemical->formula }}</td>
                <td class="py-2 px-4 border-b">{{ $chemical->description }}</td>
                <td class="py-2 px-4 border-b">
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

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $chemicals->links() }}
    </div>
@endsection
