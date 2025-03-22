<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chemical Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="min-h-screen bg-gray-100">

    <div class="container flex items-center justify-center  mx-auto h-screen">
        <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md">
            <h1 class="h1-screen">Chemical Store Login</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="div-full">
                    <label for="username" class="form-label">Username:</label>
                    <input class="form-input" type="text" name="username" id="username" required>
                </div>
                <div class="div-full">
                    <label for="password" class="form-label">Password:</label>
                    <input class="form-input" type="password" name="password" id="password" required>
                </div>
                <div class="div-full">
                    <button type="submit" class="button-submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

