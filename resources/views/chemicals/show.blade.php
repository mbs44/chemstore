<!-- resources/views/chemicals/show.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <!-- Render Breadcrumbs -->
        @if($chemical)
        <h1 class="h1-screen">Chemical Details</h1>
        <div class="div-full">
            <p class="mt-2"><strong>Chemical Formulae:</strong> {!!  $chemical->visualizeChemicalFormula($chemical->chemical_formula) !!}</p>
            <p class="mt-2"><strong>Name (EN):</strong> {{ $chemical->chemical_name_en }}</p>
            <p class="mt-2"><strong>Name (SK):</strong> {{ $chemical->chemical_name_sk }}</p>
            <p class="mt-2"><strong>Supplies:</strong> {{ $chemical->supplies->name_en }}</p>
            <p class="mt-2"><strong>Measure Unit:</strong> {{ $chemical->measureUnit->name ?? 'N/A' }}</p> <!-- Assuming we have a relationship defined -->
            <p class="mt-2"><strong>Disposal (EN):</strong> {{ $chemical->disposal_en }}</p>
            <p class="mt-2"><strong>Disposal (SK):</strong> {{ $chemical->disposal_sk }}</p>
            <p class="mt-2"><strong>Access (EN):</strong> {{ $chemical->access_en }}</p>
            <p class="mt-2"><strong>Access (SK):</strong> {{ $chemical->access_sk }}</p>

            <p class="mt-2"><strong>Created At:</strong> {{ $chemical->created_at }}</p>
            <p class="mt-2"><strong>Updated At:</strong> {{ $chemical->updated_at }}</p>
            <p class="mt-2"><strong>Dangerous Properties:</strong></p>
            <ul>
                @if($chemical->dangerousProperties->isEmpty())
                    <li>No dangerous properties associated with this chemical.</li>
                @else
                    @foreach($chemical->dangerousProperties as $property)
                        <li><strong>{{ $property->code }}</strong> ({{ $property->name_en }} / {{ $property->name_sk }})</li>
                        <li> {{ $property->description_en }}</li>
                        <li> {{ $property->description_sk }}</li>

                    @endforeach
                @endif
            </ul>

            <p class="mt-2"><strong>Safety Items</strong></p>
            <ul>
                @if($chemical->dangerousProperties->isEmpty())
                    <li>No safety items associated with this chemical.</li>
                @else
                    @foreach($chemical->safetyItems as $item)
                        <li>{{ $item->name_en }} / {{ $item->name_sk }}</li>
                    @endforeach
                @endif
            </ul>
            <p class="mt-2"><strong>Description (EN):</strong> {{ $chemical->description_en }}</p>
            <p class="mt-2"><strong>Description (SK):</strong> {{ $chemical->description_sk }}</p>
        </div>
        @else
            <p>No chemical found.</p>
        @endif
        <a href="{{ route('chemicals.index') }}" class="button-submit">Back to List</a>
    </div>
@endsection
