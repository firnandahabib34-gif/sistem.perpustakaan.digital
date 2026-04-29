<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Perpustakaan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/styles_habib.css') }}">
</head>

<body>

<nav>
    <a href="/home">Home</a>
    <a href="/product">Product</a>
    <a href="/about">About</a>
    <a href="/contact">Contact</a>
    <a href="/login">Login</a>
    <a href="/register">Register</a>
    <a href="/dashboard">Dashboard</a>
</nav>

<hr>

<div class="container">
    @yield('content')
</div>

</body>