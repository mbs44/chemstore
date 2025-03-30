<!-- resources/views/chemicals/show.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <!-- Render Breadcrumbs -->
        @if($request)
        <h1 class="h1-screen">{{$isEnglish?'Request Details':'Detaily žiadosti'}}</h1>
            @if ( $allowApproval )
                @if ( $request->state_id == 1 || $request->state_id == 2 ) <!-- initial -->
                <form action="{{ route('request.approve') }}" method="POST"
                      style="display:inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <button type="submit" class="button-add-item">{{$isEnglish?'Approve Request':'Schváliť žiadosť'}}</button>
                </form>
                @endif
                @if ( $request->state_id == 3 )  <!-- approved -->
                <form action="{{ route('request.process') }}" method="POST"
                      style="display:inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <button type="submit" class="button-submit">{{$isEnglish?'Issue Chemicals':'Vydať chemikálie'}}</button>
                </form>
                @endif
                @if ( $request->state_id == 3 || $request->state_id == 1 || $request->state_id == 4) <!-- approved or initial -->
                <form action="{{ route('request.cancel') }}" method="POST"
                      style="display:inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <button type="submit" class="button-delete">{{$isEnglish?'Cancel Request':'Zrušiť žiadosť'}}</button>
                </form>
                @endif
            @endif
        <div class="div-full">
            @if ( $isEnglish )
                <p class="mt-2"><strong>Requested By: </strong>{{ $request->requestedBy->username }}</p>
                <p class="mt-2"><strong>State: </strong>{{ $request->state->name_en }}</p>
                <p class="mt-2"><strong>Experiment: </strong>{{ $request->experiment->name_en }}</p>
                <p class="mt-2"><strong>Experiment Date: </strong>{{ $request->localDate($request->experiment_date) }}</p>
                <p class="mt-2"><strong>Note: </strong>{{ $request->note }}</p>
                <p class="mt-2"><strong>Teacher Note: </strong>{{ $request->teacher_note }}</p>
                <p class="mt-2"><strong>Resolved Date: </strong>{{ $request->localDate($request->resolved_date) }}</p>
                <p class="mt-2"><strong>Resolved By: </strong>{{ $request->resolvedBy?->username }}</p>

                <p class="mt-2"><strong>Created At:</strong> {{ $request->created_at }}</p>
                <p class="mt-2"><strong>Updated At:</strong> {{ $request->updated_at }}</p>

                <p class="mt-2"><strong>Chemicals Requested:</strong></p>

            @else
                <p class="mt-2"><strong>Žiadateľ: </strong>{{ $request->requestedBy->username }}</p>
                <p class="mt-2"><strong>Stav: </strong>{{ $request->state->name_sk }}</p>
                <p class="mt-2"><strong>Experiment: </strong>{{ $request->experiment->name_sk }}</p>
                <p class="mt-2"><strong>Dátum experimentu: </strong>{{ $request->localDate($request->experiment_date) }}</p>
                <p class="mt-2"><strong>Poznámka: </strong>{{ $request->note }}</p>
                <p class="mt-2"><strong>Poznámka učiteľa: </strong>{{ $request->teacher_note }}</p>
                <p class="mt-2"><strong>Vybavené dňa: </strong>{{ $request->localDate($request->resolved_date) }}</p>
                <p class="mt-2"><strong>Vybavil: </strong>{{ $request->resolvedBy?->username }}</p>

                <p class="mt-2"><strong>Zadané dňa:</strong> {{ $request->created_at }}</p>
                <p class="mt-2"><strong>Zmenené dňa:</strong> {{ $request->updated_at }}</p>

                <p class="mt-2"><strong>Požadované chemikálie:</strong></p>
            @endif
            <ul>
                @if($request->chemicals->isEmpty())
                    @if ( $isEnglish )
                        <li>No chemicals added on this request.</li>
                    @else
                        <li>Na tejto žiadosti nie sú pridané žiadne chemikálie.</li>
                    @endif
                @else
                    @foreach($request->chemicals as $chemical)
                        <li class="mt-2"> {{ $chemical->pivot->quantity }} {{ $chemical->measureUnit->name }}
                            <strong>{{$isEnglish?'of chemical':'z chemikálie'}}</strong>
                            {{ $isEnglish?$chemical->chemical_name_en : $chemical->chemical_name_sk }} - {!! $chemical->visualizeChemicalFormula($chemical->chemical_formula) !!}
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        @else
            <p>{{$isEnglish?'No Request found':'Žiadosť sa nenašla'}}.</p>
        @endif
        <a href="{{ route('requests.index') }}" class="button-submit">{{$isEnglish?'Back to List':'Späť na zoznam'}}</a>
    </div>
@endsection
