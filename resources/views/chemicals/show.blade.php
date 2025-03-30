<!-- resources/views/chemicals/show.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <!-- Render Breadcrumbs -->
        @if($chemical)
        <h1 class="h1-screen">{{$isEnglish?'Chemical Details':'Detaily o chemikálii'}}</h1>
        <div class="div-full">
            <p class="mt-2"><strong>{{$isEnglish?'Chemical Formulae':'Chemický vzorec'}}:</strong>
                {!! $chemical->visualizeChemicalFormula($chemical->chemical_formula) !!}
            </p>
            @if ( $isEnglish )
                <p class="mt-2"><strong>Name:</strong> {{ $chemical->chemical_name_en }}</p>
                <p class="mt-2"><strong>Supplies:</strong> {{ $chemical->supplies->name_en }}</p>
                <p class="mt-2"><strong>Measure Unit:</strong> {{ $chemical->measureUnit->name ?? 'N/A' }}</p> <!-- Assuming we have a relationship defined -->
                <p class="mt-2"><strong>Disposal:</strong> {{ $chemical->disposal_en }}</p>
                <p class="mt-2"><strong>Access:</strong> {{ $chemical->access_en }}</p>
                <p class="mt-2"><strong>Description:</strong> {{ $chemical->description_en }}</p>

                <p class="mt-2"><strong>Dangerous Properties:</strong></p>
                <ul>
                    @if($chemical->dangerousProperties->isEmpty())
                        <li>No dangerous properties associated with this chemical.</li>
                    @else
                        @foreach($chemical->dangerousProperties as $property)
                            <li><strong>{{ $property->code }}</strong> {{ $property->name_en }}</li>
                            <li> {{ $property->description_en }}</li>
                        @endforeach
                    @endif
                </ul>

                <p class="mt-2"><strong>Safety Items</strong></p>
                <ul>
                    @if($chemical->dangerousProperties->isEmpty())
                        <li>No safety items associated with this chemical.</li>
                    @else
                        @foreach($chemical->safetyItems as $item)
                            <li>{{ $item->name_en }}</li>
                        @endforeach
                    @endif
                </ul>

                <p class="mt-2"><strong>Created At:</strong> {{ $chemical->created_at }}</p>
                <p class="mt-2"><strong>Updated At:</strong> {{ $chemical->updated_at }}</p>
            @else
                <p class="mt-2"><strong>Názov:</strong> {{ $chemical->chemical_name_sk }}</p>
                <p class="mt-2"><strong>Zásoby:</strong> {{ $chemical->supplies->name_sk }}</p>
                <p class="mt-2"><strong>Merná jednotka:</strong> {{ $chemical->measureUnit->name ?? 'N/A' }}</p> <!-- Assuming we have a relationship defined -->
                <p class="mt-2"><strong>Odpad:</strong> {{ $chemical->disposal_sk }}</p>
                <p class="mt-2"><strong>Prístup:</strong> {{ $chemical->access_sk }}</p>
                <p class="mt-2"><strong>Popis:</strong> {{ $chemical->description_sk }}</p>

                <p class="mt-2"><strong>Nebezpečné vlastnosti:</strong></p>
                <ul>
                    @if($chemical->dangerousProperties->isEmpty())
                        <li>Ku tejto chemikálii nie sú priradené žiadne nebezpečné vlastnosti.</li>
                    @else
                        @foreach($chemical->dangerousProperties as $property)
                            <li><strong>{{ $property->code }}</strong> {{ $property->name_sk }}</li>
                            <li> {{ $property->description_sk }}</li>
                        @endforeach
                    @endif
                </ul>

                <p class="mt-2"><strong>Bezpečnostné pomôcky</strong></p>
                <ul>
                    @if($chemical->dangerousProperties->isEmpty())
                        <li>Ku tejto chemikálii nie sú priradené žiadne bezpečnostné pomôcky.</li>
                    @else
                        @foreach($chemical->safetyItems as $item)
                            <li>{{ $item->name_sk }}</li>
                        @endforeach
                    @endif
                </ul>

                <p class="mt-2"><strong>Vytvorené:</strong> {{ $chemical->created_at }}</p>
                <p class="mt-2"><strong>Zmenené:</strong> {{ $chemical->updated_at }}</p>
            @endif

        </div>
        @else
            <p>{{$isEnglish?'No chemical found.':'Chemikália neexistuje.'}}</p>
        @endif
        <a href="{{ route('chemicals.index') }}" class="button-submit">{{$isEnglish?'Back to List':'Späť na zoznam'}}</a>
    </div>
@endsection
