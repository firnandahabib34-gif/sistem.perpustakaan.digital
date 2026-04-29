@extends('layouts.landing')

@section('content')
<h1>Register</h1>

<form>
    <label>Nama</label><br>
    <input type="text"><br><br>

    <label>Email</label><br>
    <input type="email"><br><br>

    <label>Password</label><br>
    <input type="password"><br><br>

    <button type="submit">Daftar</button>
</form>
@endsection