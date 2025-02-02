<!-- resources/views/chemicals/create.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <h1 class="h1-screen">Add New Chemical</h1>

        <form action="{{ route('chemicals.store') }}" method="POST">
            @csrf
            <div class="div-form">
                <div class="div-input">
                    <label for="chemical_name_en" class="form-label">Name English</label>
                    <input type="text" class="form-input" id="chemical_name_en"
                           name="chemical_name_en" required>
                </div>
                <div class="div-input">
                    <label for="chemical_name_sk" class="form-label">Name Slovak</label>
                    <input type="text" class="form-input" id="chemical_name_sk"
                           name="chemical_name_sk" required>
                </div>
                <div class="div-input">
                    <label for="chemical_formula" class="form-label">Formula</label>
                    <input type="text" class="form-input" id="chemical_formula"
                           name="chemical_formula" required>
                </div>
                <div class="div-input">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="text" class="form-input" id="quantity" name="quantity" required>
                </div>
                <div class="div-input">
                    <label for="measure_unit_id" class="form-label">Measure Unit</label>
                    <select id="measure_unit_id" name="measure_unit_id" class="form-input" required>
                        <option value="">Select a measure unit</option>
                        @foreach ($measureUnits as $unit)
                            <option value="{{ $unit->id }}" {{ old('measure_unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="div-full">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-textarea" id="description" name="Description"></textarea>
                </div>
            </div>
            <button type="submit" class="button-submit">Add Chemical</button>
            <a href="{{ route('chemicals.index') }}" class="button-cancel">Cancel</a>

        </form>
    </div>
@endsection
