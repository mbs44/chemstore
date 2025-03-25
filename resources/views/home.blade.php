<!-- resources/views/home.blade.php -->

<!-- resources/views/home.blade.php -->

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
<body>
<div class="container mx-auto mt-4">
    <header>
        <div class="flex m-0 p-0">
            <div class="flex items-center justify-center bg-white shadow-lg p-0">
                <img src="{{ asset('images/logo5.png') }}" alt="Chemical Store Logo" class="h-64">
            </div>
            <!-- Right Part: Text -->

            <div class="flex-1 bg-gray-200 p-4">

                <h1 class="h1-screen">Welcome to Our School Chemical Store</h1>
                <h2 class="h2-screen">Your Trusted Source for Quality Chemicals</h2>
                <p class="mt-2 text-gray-600">Your trusted source for quality chemicals. Explore our supplies and find
                    what you need!</p>
                @if (Auth::check())
                    <p>Hello, You are logged in as {{ Auth::user()->uid[0] }}</p>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <a href="{{ route('chemicals.index') }}" class="button-submit">Enter In</a>
                        <button type="submit" class="button-cancel">Logout</button>
                    </form>
                @else
                    <p>You are not logged in.</p>
                    <div class="p-4">
                    <a href="{{ route('login') }}" class="button-submit">Login</a>
                    </div>
                @endif
            </div>
        </div>

    </header>

    <main class="mt-4">
        <section class="featured-products mt-5">
            <h2 class="h2-screen text-center">Explore our application features</h2>
            <div id="carouselHome" class="relative" data-carousel="slide">
                <div class="relative h-56 overflow-hidden rounded-lg md:h-[832px]">
                    <div class="hidden duration-5000 ease-in-out" data-carousel-item="active">
                        <p>We provide a wide range of chemicals for various experiments. Explore our storage and find
                            what you need!</p>
                        <img src="{{ asset('images/chemicals.jpg') }}" class="block w-full" alt="Product 1">
                    </div>
                    <div class="hidden duration-5000 ease-in-out" data-carousel-item>
                        <p>Choose your favorite chemical experiment you want to try!</p>
                        <img src="{{ asset('images/experiments.jpg') }}" class="block w-full" alt="Product 2">
                    </div>
                    <div class="hidden duration-5000 ease-in-out" data-carousel-item>
                        <p>Ask your teacher for chemicals your experiment require. Maybe you'll be lucky today!</p>
                        <img src="{{ asset('images/requests.jpg') }}" class="block w-full" alt="Product 3">
                    </div>
                </div>

                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                            data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                            data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                            data-carousel-slide-to="2"></button>
                </div>

                <button type="button"
                        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
                        <svg class="w-5 h-5 text-gray-800" fill="currentColor" viewBox="0 0 20 20"><path
                                d="M12.293 15.293a1 1 0 01-1.414 0L7.293 12.414a1 1 0 010-1.414l3.586-3.586a1 1 0 011.414 1.414L9.414 11H16a1 1 0 110 2H9.414l2.879 2.879a1 1 0 010 1.414z"/></svg>
                    </span>
                </button>
                <button type="button"
                        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
                        <svg class="w-5 h-5 text-gray-800" fill="currentColor" viewBox="0 0 20 20"><path
                                d="M7.707 15.293a1 1 0 001.414 0L12.707 12.414a1 1 0 000-1.414l-3.586-3.586a1 1 0 00-1.414 1.414L10.586 11H4a1 1 0 100 2h6.586l-2.879 2.879a1 1 0 000 1.414z"/></svg>
                    </span>
                </button>
                <!-- Slider indicators -->
            </div>
        </section>
    </main>

    <footer class="text-center mt-5">
        <p>Contact us: info@chemicalstore.com | Follow us on social media!</p>
    </footer>
</div>
</body>
</html>
