<!-- resources/views/chemicals/show.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <!-- Render Breadcrumbs -->
        @if($chemical)
        <h1 class="h1-screen">Chemical Details</h1>
        <div class="div-full">
            <p class="mt-2"><strong>Chemical Formula:</strong> {!!  $chemical->visualizeChemicalFormula($chemical->chemical_formula) !!}</p>
            <p class="mt-2"><strong>Chemical Name (EN):</strong> {{ $chemical->chemical_name_en }}</p>
            <p class="mt-2"><strong>Chemical Name (SK):</strong> {{ $chemical->chemical_name_sk }}</p>
            <p class="mt-2"><strong>Quantity:</strong> {{ $chemical->quantity }}</p>
            <p class="mt-2"><strong>Measure Unit:</strong> {{ $chemical->measureUnit->name ?? 'N/A' }}</p> <!-- Assuming we have a relationship defined -->
            <p class="mt-2"><strong>Description:</strong> {{ $chemical->description }}</p>
            <p class="mt-2"><strong>Created At:</strong> {{ $chemical->created_at }}</p>
            <p class="mt-2"><strong>Updated At:</strong> {{ $chemical->updated_at }}</p>

            <p class="mt-2"><strong>Dangerous Properties</strong></p>
            <ul>
                @if($chemical->dangerousProperties->isEmpty())
                    <li>No dangerous properties associated with this chemical.</li>
                @else
                    @foreach($chemical->dangerousProperties as $property)
                        <li>{{ $property->name_en }}: {{ $property->description_en }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
        @else
            <p>No chemical found.</p>
        @endif
        <a href="{{ route('chemicals.index') }}" class="button-submit">Back to List</a>
    </div>
@endsection
