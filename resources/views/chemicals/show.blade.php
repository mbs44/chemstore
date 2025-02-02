<!-- resources/views/chemicals/show.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <!-- Render Breadcrumbs -->

        <h1 class="h1-screen">{{ $chemical->chemical_formula }}</h1>
        <div class="div-full">
            <p class="mt-2"><strong>Chemical Name (EN):</strong> {{ $chemical->chemical_name_en }}</p>
            <p class="mt-2"><strong>Chemical Name (SK):</strong> {{ $chemical->chemical_name_sk }}</p>
            <p class="mt-2"><strong>Quantity:</strong> {{ $chemical->quantity }}</p>
            <p class="mt-2"><strong>Measure Unit:</strong> {{ $chemical->measure_unit_id }}</p>
            <p class="mt-2"><strong>Description:</strong> {{ $chemical->description }}</p>
            <p class="mt-2"><strong>Created At:</strong> {{ $chemical->created_at }}</p>
            <p class="mt-2"><strong>Updated At:</strong> {{ $chemical->updated_at }}</p>
        </div>
        <a href="{{ route('chemicals.index') }}" class="button-submit">Back to List</a>
    </div>
@endsection
