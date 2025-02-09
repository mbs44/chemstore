<!-- resources/views/chemicals/show.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <!-- Render Breadcrumbs -->
        @if($experiment)
            <h1 class="h1-screen">Experiment {{ $experiment->name_en }}</h1>
            <div class="div-full">
                <p class="mt-2"><strong>Name (EN):</strong> {{ $experiment->name_en }}</p>
                <p class="mt-2"><strong>Name (SK):</strong> {{ $experiment->name_sk }}</p>
                <p class="mt-2"><strong>Description (EN):</strong> {{ $experiment->description_en }}</p>
                <p class="mt-2"><strong>Description (SK):</strong> {{ $experiment->description_sk }}</p>
                <p class="mt-2"><strong>Created At:</strong> {{ $experiment->created_at }}</p>
                <p class="mt-2"><strong>Updated At:</strong> {{ $experiment->updated_at }}</p>

                <p class="mt-2"><strong>Chemicals</strong></p>
                <ul>
                    @if($experiment->chemicals->isEmpty())
                        <li>No chemicals associated with this experiment.</li>
                    @else
                        @foreach($experiment->chemicals as $chemical)
                            <li>{{ $chemical->chemical_formula }}: {{ $chemical->chemical_name_en }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
        @else
            <p>No experiment found.</p>
        @endif
        <a href="{{ route('experiments.index') }}" class="button-submit">Back to List</a>
    </div>
@endsection
