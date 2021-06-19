<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

</head>
<body>
    <header>
        <a href="/" class="logo">
            <img src="{{ asset('logo.svg') }}" alt="LOGO">
        </a>
        @auth
            <a href="{{ url('/tasks') }}" class="toplink">Tasks</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="toplink">Log out</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="toplink">Log in</a>
            <a href="{{ route('register') }}" class="toplink">Register</a>
        @endauth

    </header>
    <main>
        {{ $slot }}
    </main>
</body>
</html>
