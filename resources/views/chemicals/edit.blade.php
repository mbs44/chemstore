<!-- resources/views/chemicals/edit.blade.php -->

@extends('layout')

@section('content')
    <div class="div-container">
        <h1 class="h1-screen">Update Chemical</h1>

        <form action="{{ route('chemicals.update', $chemical->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="div-form">
                <div class="div-input">
                    <label for="chemical_name_en" class="form-label">Chemical Name
                        (EN)</label>
                    <input type="text" id="chemical_name_en" name="chemical_name_en"
                           value="{{ old('chemical_name_en', $chemical->chemical_name_en) }}"
                           class="form-input" required>
                </div>

                <div class="div-input">
                    <label for="chemical_name_sk" class="form-label">Chemical Name
                        (SK)</label>
                    <input type="text" id="chemical_name_sk" name="chemical_name_sk"
                           value="{{ old('chemical_name_sk', $chemical->chemical_name_sk) }}"
                           class="form-input" required>
                </div>

                <div class="div-input">
                    <label for="chemical_formula" class="form-label">Chemical
                        Formula</label>
                    <input type="text" id="chemical_formula" name="chemical_formula"
                           value="{{ old('chemical_formula', $chemical->chemical_formula) }}"
                           class="form-input" required>
                </div>

                <div class="div-input">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantity" name="quantity"
                           value="{{ old('quantity', $chemical->quantity) }}"
                           class="form-input" required>
                </div>

                <div class="div-input">
                    <label for="measure_unit_id" class="form-label">Measure Unit</label>
                    <input type="text" id="measure_unit_id" name="measure_unit_id"
                           value="{{ old('measure_unit_id', $chemical->measure_unit_id) }}"
                           class="form-input" required>
                </div>

                <div class="div-full">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="form-input">{{ old('description', $chemical->description) }}</textarea>
                </div>
            </div>
            <button type="submit" class="button-submit">Update Chemical</button>
            <a href="{{ route('chemicals.index') }}" class="button-cancel">Cancel</a>


        </form>


    </div>
@endsection
