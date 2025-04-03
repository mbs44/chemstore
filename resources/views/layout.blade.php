<!-- resources/views/layout.blade.php -->

{{-- Common content for all authenticated screens --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chemical Store</title>
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ mix('build/assets/app.css') }}">
        <script src="{{ mix('build/assets/app.js') }}" defer></script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Use Vite helper -->
    @endif
</head>
<body class="bg-gray-100">
<div class="min-h-screen bg-gray-100">

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">

                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">

{{--                    Application menu items--}}
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <a href="{{ route('home') }}" class="text-lg font-bold">{{$isEnglish?'Chemical Store':'Chemický sklad'}}</a>
                            <a href="{{ route('requests.index') }}"
                               class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">{{$isEnglish?'Requests':'Žiadosti'}}</a>

                            <a href="{{ route('chemicals.index') }}"
                               class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">{{$isEnglish?'Chemicals':'Chemikálie'}}</a>
                            <a href="{{ route('experiments.index') }}"
                               class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">{{$isEnglish?'Experiments':'Experimenty'}}</a>

                            @if ( App\Http\Controllers\UserController::isAdmin() )
                                <a href="{{ route('users.index') }}"
                                   class="text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">Users</a>
                            @endif

                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit"
                                        class="btn text-gray-900 hover:bg-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                                    {{$isEnglish?'Logout':'Odhlásenie'}}
                                </button>
                            </form>

                            <div class="relative inline-block text-left">
                                <form action="{{ route('language.change') }}" method="POST">
                                    @csrf
                                    {{--Language dropdown with images--}}
                                    <div>
                                        <button id="dropdownButton" type="button"
                                                class="inline-flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                                                aria-haspopup="true" aria-expanded="true">
                                            @if ( $isEnglish )
                                                <img
                                                    src="https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg"
                                                    alt="UK Flag" class="w-5 h-5 mr-2"> English
                                            @else
                                                <img
                                                    src="https://upload.wikimedia.org/wikipedia/commons/e/e6/Flag_of_Slovakia.svg"
                                                    alt="Slovakia Flag" class="w-5 h-5 mr-2"> Slovensky
                                            @endif
                                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <div id="dropdownMenu"
                                         class="hidden absolute z-10 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                         role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton">
                                        <div class="py-1" role="none">
                                            <button type="submit" name="language" value="sk"
                                                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    role="menuitem">
                                                <img
                                                    src="https://upload.wikimedia.org/wikipedia/commons/e/e6/Flag_of_Slovakia.svg"
                                                    alt="Slovakia Flag" class="w-5 h-5 mr-2"> Slovensky
                                            </button>
                                            <button type="submit" name="language" value="en"
                                                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    role="menuitem">
                                                <img
                                                    src="https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg"
                                                    alt="UK Flag" class="w-5 h-5 mr-2"> English
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="container mx-auto px-4 py-2">
{{-- Generate breadcrumb --}}
        <nav class="flex" aria-label="breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                @foreach (Breadcrumbs::generate() as $breadcrumb)
                    <li class="inline-flex items-center">
                        @if (!$loop->last)
                            <a href="{{ $breadcrumb->url }}" class="text-gray-700 hover:text-blue-600">
                                {{ $breadcrumb->title }}
                            </a>
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10.293 15.293a1 1 0 001.414 0l4-4a1 1 0 00-1.414-1.414L11 12.586V3a1 1 0 00-2 0v9.586l-3.293-3.293a1 1 0 00-1.414 1.414l4 4z"
                                      clip-rule="evenodd"/>
                            </svg>
                        @else
                            <span class="text-gray-500">{{ $breadcrumb->title }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

    </div>

{{--    Generic display error section--}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </span>
        </div>
    @endif

{{--    Content of the screen --}}
    <div class="container mx-auto mt-4">
        @yield('content')
    </div>
</div>

<script>
    // Javascript support for changing language dropdown with images
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // Close the dropdown if clicked outside
    window.addEventListener('click', (event) => {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>

</body>
</html>

