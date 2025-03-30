<!-- resources/views/chemicals/show.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <!-- Render Breadcrumbs -->
        @if($experiment)
            <h1 class="h1-screen">{{$isEnglish?'Experiment Details':'Detaily o experimente'}}</h1>
            <div class="div-full">
                @if ( $isEnglish )
                    <p class="mt-2"><strong>Name:</strong> {{ $experiment->name_en }}</p>
                    <p class="mt-2"><strong>Description:</strong> {{ $experiment->description_en }}</p>

                    <p class="mt-2"><strong>Chemicals</strong></p>
                    <ul>
                        @if($experiment->chemicals->isEmpty())
                            <li>No chemicals associated with this experiment.</li>
                        @else
                            @foreach($experiment->chemicals as $chemical)
                                <li>{!! $chemical->visualizeChemicalFormula($chemical->chemical_formula) !!} : {{ $chemical->chemical_name_en }}</li>
                            @endforeach
                        @endif
                    </ul>
                    <p class="mt-2"><strong>Created At:</strong> {{ $experiment->created_at }}</p>
                    <p class="mt-2"><strong>Updated At:</strong> {{ $experiment->updated_at }}</p>
                @else
                    <p class="mt-2"><strong>Názov:</strong> {{ $experiment->name_sk }}</p>
                    <p class="mt-2"><strong>Popis:</strong> {{ $experiment->description_sk }}</p>

                    <p class="mt-2"><strong>Chemikálie</strong></p>
                    <ul>
                        @if($experiment->chemicals->isEmpty())
                            <li>K tomuto experimentu nie sú priradené žiadne chemikálie.</li>
                        @else
                            @foreach($experiment->chemicals as $chemical)
                                <li>{!! $chemical->visualizeChemicalFormula($chemical->chemical_formula) !!} : {{ $chemical->chemical_name_sk }}</li>
                            @endforeach
                        @endif
                    </ul>
                    <p class="mt-2"><strong>Vytvorené:</strong> {{ $experiment->created_at }}</p>
                    <p class="mt-2"><strong>Zmenené:</strong> {{ $experiment->updated_at }}</p>
                @endif

            </div>
        @else
            <p>No experiment found.</p>
        @endif
        <a href="{{ route('experiments.index') }}" class="button-submit">{{$isEnglish?'Back to List':'Späť na zoznam'}}</a>
    </div>
@endsection
