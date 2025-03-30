<!-- resources/views/chemicals/index.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <h1 class="h1-screen">{{$isEnglish?'Search Chemicals':'Vyhľadaj chemikálie'}}</h1>

        <!-- Filter Form -->
        <form action="{{ route('chemicals.index') }}" method="GET">
            <div class="div-form">
                @if ( $isEnglish )
                <div class="div-input">
                    <label for="chemical_name_en" class="form-label">Name</label>
                    <input type="text" class="form-input" id="chemical_name_en" name="chemical_name_en"
                           value="{{ request()->input('chemical_name_en') }}">
                </div>
                @else
                <div class="div-input">
                    <label for="chemical_name_sk" class="form-label">Názov</label>
                    <input type="text" class="form-input" id="chemical_name_sk" name="chemical_name_sk"
                           value="{{ request()->input('chemical_name_sk') }}">
                </div>
                @endif
                <div class="div-input">
                    <label for="chemical_formula" class="form-label">{{$isEnglish?'Chemical Formulae':'Chemický vzorec'}}</label>
                    <input type="text" class="form-input" id="chemical_formula" name="chemical_formula"
                           value="{{ request()->input('chemical_formula') }}">
                </div>
                <div class="div-input">
                    <label for="supplies_id" class="form-label">{{$isEnglish?'Supplies':'Zásoby'}}</label>
                    <select id="supplies_id" name="supplies_id" class="form-input">
                        <option value="">{{$isEnglish?'Select a supplies level':'Zvoľ si úroveň zásob'}}</option>
                        @foreach ($supplies as $item)
                            <option value="{{ $item->id }}" {{ request()->input('supplies_id') == $item->id ? 'selected' : '' }}>
                                {{ $isEnglish?$item->name_en : $item->name_sk}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="div-input">
                    <label for="measure_unit_id" class="form-label">{{$isEnglish?'Measure Unit':'Merná jednotka'}}</label>
                    <select id="measure_unit_id" name="measure_unit_id" class="form-input">
                        <option value="">{{$isEnglish?'Select a measure unit':'Zvoľ si mernú jednotku'}}</option>
                        @foreach ($measureUnits as $unit)
                            <option value="{{ $unit->id }}" {{ request()->input('measure_unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="div-full">
                    <label for="dangerous_properties" class="form-label">{{$isEnglish?'Dangerous Properties':'Nebezpečné vlastnosti'}}:</label>

                    <!-- Select -->
                    <select id="dangerous_properties" name="dangerous_properties[]" multiple="" data-hs-select='{
  "placeholder": "{{$isEnglish?'Select dangerous property':'Zvoľ si nebezpečné vlastnosti'}} ...",
  "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
  "mode": "tags",
  "wrapperClasses": "relative ps-0.5 pe-9 min-h-[46px] flex items-center flex-wrap text-nowrap w-full border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400",
  "tagsItemTemplate": "<div class=\"flex flex-nowrap items-center relative z-10 bg-white border border-gray-200 rounded-full p-1 m-1 dark:bg-neutral-900 dark:border-neutral-700 \"><div class=\"whitespace-nowrap text-gray-800 dark:text-neutral-200 \" data-title></div><div class=\"inline-flex shrink-0 justify-center items-center size-5 ms-2 rounded-full text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm dark:bg-neutral-700/50 dark:hover:bg-neutral-700 dark:text-neutral-400 cursor-pointer\" data-remove><svg class=\"shrink-0 size-3\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M18 6 6 18\"/><path d=\"m6 6 12 12\"/></svg></div></div>",
  "tagsInputId": "hs-tags-input",
  "tagsInputClasses": "py-3 px-2 rounded-lg order-1 text-sm outline-none dark:bg-neutral-900 dark:placeholder-neutral-500 dark:text-neutral-400",
  "optionTemplate": "<div class=\"flex items-center\"><div><div class=\"text-sm font-semibold text-gray-800 dark:text-neutral-200 \" data-title></div><div class=\"text-xs text-gray-500 dark:text-neutral-500 \" data-description></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
  "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
}' class="hidden">
                        @foreach($dangerousProperties as $property)
                            <option {{ in_array($property->id, $selectedProperties) ? 'selected=""' : '' }}
                                    value="{{ $property->id }}">{{$isEnglish ? $property->name_en : $property->name_sk }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="div-full">
                    <button type="submit" class="button-submit">{{$isEnglish?'Filter':'Vyhľadaj'}}</button>
                </div>
            </div>

        </form>

        <table class=table-result>
            <thead>
            <tr>
                @if ( $isEnglish )
                <th class="table-col">
                    <a href="{{ route('chemicals.index', ['sort' => 'chemical_name_en', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Name
                        @if ($sortColumn === 'chemical_name_en')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                @else
                <th class="table-col">
                    <a href="{{ route('chemicals.index', ['sort' => 'chemical_name_sk', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        Názov
                        @if ($sortColumn === 'chemical_name_sk')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                @endif
                <th class="table-col">
                    <a href="{{ route('chemicals.index', ['sort' => 'chemical_formula', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        {{$isEnglish?'Chemical Formulae':'Chemický vzorec'}}
                        @if ($sortColumn === 'chemical_formula')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('chemicals.index', ['sort' => 'supplies_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        {{$isEnglish?'Supplies':'Zásoby'}}
                        @if ($sortColumn === 'supplies_id')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">
                    <a href="{{ route('chemicals.index', ['sort' => 'measure_unit_id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}"
                       class="table-sort">
                        {{$isEnglish?'Measure Unit':'Merná jednotka'}}
                        @if ($sortColumn === 'measure_unit_id')
                            <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th class="table-col">{{$isEnglish?'Actions':'Akcie'}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($chemicals as $chemical)
                <tr>
                    @if ( $isEnglish )
                    <td class="table-cell text-left">{{ $chemical->chemical_name_en }}</td>
                    @else
                    <td class="table-cell text-left">{{ $chemical->chemical_name_sk }}</td>
                    @endif
                    <td class="table-cell text-left">{!! $chemical->visualizeChemicalFormula($chemical->chemical_formula) !!}</td>
                    <td class="table-cell text-left">{{ $isEnglish ? $chemical->supplies->name_en : $chemical->supplies->name_sk }}</td>
                    <td class="table-cell text-left">{{ $chemical->measureUnit->name ?? 'N/A' }}</td>

                    <td class="table-cell">
                        <!-- You can add more action links here, like Edit or Delete -->
                        <a href="{{ route('chemicals.show', $chemical->id) }}" class="bg-blue-500 button-action">{{$isEnglish?'View':'Zobraziť'}}</a>
                        @if ( $allowEdit )
                        <a href="{{ route('chemicals.edit', $chemical) }}" class="bg-yellow-500 button-action">{{$isEnglish?'Edit':'Zmeniť'}}</a>
                        <form action="{{ route('chemicals.destroy', $chemical) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 button-action">{{$isEnglish?'Delete':'Zmazať'}}</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="mt-4">
            {{ $chemicals->appends(['sort' => $sortColumn, 'direction' => $sortDirection])->links() }}
        </div>

        @if ( $allowEdit )
            <a href="{{ route('chemicals.create') }}" class="button-submit">{{$isEnglish?'Add New Chemical':'Pridať novú chemikáliu'}}</a>
        @endif
    </div>
@endsection
