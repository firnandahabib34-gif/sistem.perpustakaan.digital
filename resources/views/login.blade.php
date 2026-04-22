@extends('layouts.landing')

@section('content')
<h1>Login</h1>

<form>
    <label>Email</label><br>
    <input type="email"><br><br>

    <label>Password</label><br>
    <input type="password"><br><br>

    <button type="submit">Login</button>
</form>
@endsection