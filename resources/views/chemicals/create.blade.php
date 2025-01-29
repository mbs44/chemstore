<!-- resources/views/chemicals/create.blade.php -->

@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add New Chemical</h1>

    <form action="{{ route('chemicals.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-input mt-1 block w-full" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="formula" class="form-label">Formula</label>
            <input type="text" class="form-input mt-1 block w-full" id="formula" name="formula" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-input mt-1 block w-full" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Chemical</button>
        <a href="{{ route('chemicals.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
    </form>
@endsection
