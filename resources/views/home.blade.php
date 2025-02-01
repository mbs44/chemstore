<!-- resources/views/home.blade.php -->

@extends('layout')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Welcome to the Chemical Store</h1>
        <p class="mt-4">Explore our wide range of chemicals for various applications.</p>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold">Featured Chemicals</h2>
            <ul class="mt-2 space-y-2">
                <li class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="font-bold">Chemical Name 1</h3>
                    <p>Short description of Chemical 1.</p>
                    <a href="{{ route('chemicals.show', 1) }}" class="text-blue-500 hover:underline">View Details</a>
                </li>
                <li class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="font-bold">Chemical Name 2</h3>
                    <p>Short description of Chemical 2.</p>
                    <a href="{{ route('chemicals.show', 2) }}" class="text-blue-500 hover:underline">View Details</a>
                </li>
                <!-- Add more chemicals as needed -->
            </ul>
        </div>
    </div>
@endsection
