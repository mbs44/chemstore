<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chemical Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Use Vite helper -->
{{--    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">--}}
</head>
<body class="bg-gray-100">
<div class="min-h-screen bg-gray-100">

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <a href="{{ route('chemicals.index') }}" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">Chemicals</a>
                    <a href="{{ route('experiments.index') }}" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">Experiments</a>
                    <a href="#" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">About</a>

                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                    </form>
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0">

                    </div>
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <a href="{{ route('home') }}" class="text-lg font-bold">Chemical Store</a>
                            <a href="{{ route('chemicals.index') }}" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">Chemicals</a>
                            <a href="{{ route('experiments.index') }}" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">Experiments</a>
                            <a href="#" class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">About</a>

                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="container mx-auto px-4 py-2">

        <nav class="flex" aria-label="breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                @foreach (Breadcrumbs::generate() as $breadcrumb)
                    <li class="inline-flex items-center">
                        @if (!$loop->last)
                            <a href="{{ $breadcrumb->url }}" class="text-gray-700 hover:text-blue-600">
                                {{ $breadcrumb->title }}
                            </a>
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.293 15.293a1 1 0 001.414 0l4-4a1 1 0 00-1.414-1.414L11 12.586V3a1 1 0 00-2 0v9.586l-3.293-3.293a1 1 0 00-1.414 1.414l4 4z" clip-rule="evenodd" />
                            </svg>
                        @else
                            <span class="text-gray-500">{{ $breadcrumb->title }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

    </div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container mx-auto mt-4">
        @yield('content')
    </div>
</div>
</body>
</html>

