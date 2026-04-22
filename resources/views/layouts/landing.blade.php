<link rel="stylesheet" href="{{ asset('css/style.css') }}">
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