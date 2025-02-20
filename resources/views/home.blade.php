<!-- resources/views/home.blade.php -->

<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chemical Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Use Vite helper -->
</head>
<body>
<div class="container mt-5">
    <h1>Welcome to Our Chemical Storage Application!</h1>

    @if (Auth::check())
        <p>Hello, {{ Auth::user()->name }}! You are logged in.</p>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @else
        <p>You are not logged in.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    @endif
</div>
</body>
</html>
