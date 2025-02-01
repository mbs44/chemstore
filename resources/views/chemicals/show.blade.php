<!-- resources/views/chemicals/show.blade.php -->

@extends('layout')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Render Breadcrumbs -->
        <h1 class="text-2xl font-bold mt-4">{{ $chemical->chemical_formula }}</h1>
        <p class="mt-2"><strong>Name EN:</strong> {{ $chemical->chemical_name_en }}</p>
        <p class="mt-2"><strong>Name SK:</strong> {{ $chemical->chemical_name_sk }}</p>
        <p class="mt-2"><strong>Quantity:</strong> {{ $chemical->quantity }}</p>
        <p class="mt-2"><strong>Measure Unit:</strong> {{ $chemical->measure_unit_id }}</p>
        <p class="mt-2"><strong>Description:</strong> {{ $chemical->description }}</p>
        <p class="mt-2"><strong>Created At:</strong> {{ $chemical->created_at }}</p>
        <p class="mt-2"><strong>Updated At:</strong> {{ $chemical->updated_at }}</p>

        <a href="{{ route('chemicals.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back to List</a>
    </div>
@endsection
