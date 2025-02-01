<!-- resources/views/chemicals/create.blade.php -->

@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add New Chemical</h1>

    <form action="{{ route('chemicals.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="chemical_name_en" class="form-label">Name English</label>
            <input type="text" class="form-input mt-1 block w-full" id="chemical_name_en" name="chemical_name_en" required>
        </div>
        <div class="mb-3">
            <label for="chemical_name_sk" class="form-label">Name Slovak</label>
            <input type="text" class="form-input mt-1 block w-full" id="chemical_name_sk" name="chemical_name_sk" required>
        </div>
        <div class="mb-3">
            <label for="chemical_formula" class="form-label">Formula</label>
            <input type="text" class="form-input mt-1 block w-full" id="chemical_formula" name="chemical_formula" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="text" class="form-input mt-1 block w-full" id="quantity" name="quantity" required>
        </div>
        <div class="mb-3">
            <label for="measure_unit_id" class="form-label">Measure Unit</label>
            <input type="text" class="form-input mt-1 block w-full" id="measure_unit_id" name="measure_unit_id" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-input mt-1 block w-full" id="description" name="Description"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Chemical</button>
        <a href="{{ route('chemicals.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
    </form>
@endsection
