@extends('layout.landing')

@section('content')
<h1>Product</h1>

@foreach($products as $p)
<div class="card">
    {{ $p['nama'] }} - Rp {{ $p['harga'] }}
</div>
<h2>Tambah Produk</h2>

<form>
    <input type="text" placeholder="Nama"><br><br>
    <input type="number" placeholder="Harga"><br><br>
    <button>Tambah produk</button>
</form>
@endforeach

@endsection

