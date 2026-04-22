@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
<div class="top-bar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div class="page-title">
        <h2>📖 Koleksi Buku</h2>
        <p>Silakan pilih buku yang ingin dipinjam</p>
    </div>
    <div class="notification-bell" onclick="showNotifications()">
        <i class="fa-regular fa-bell"></i> Notifikasi
        <span id="notifBadge" class="badge-notif">0</span>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif

<div class="search-box">
    <input type="text" id="searchBook" placeholder="Cari judul atau penulis...">
    <button class="btn-primary" onclick="filterBooks()">Cari</button>
</div>

<div class="books-grid" id="booksGrid">
    @foreach($books as $book)
    @php
        $alreadyBorrowed = $activeLoans->contains('book_id', $book->id);
    @endphp
    <div class="book-card">
        <h3>{{ $book->title }}</h3>
        <p><i class="fas fa-user-edit"></i> {{ $book->author }}</p>
        <p><i class="fas fa-tag"></i> {{ $book->category }} | 📦 Stok: {{ $book->stock }}</p>
        <form method="POST" action="{{ route('member.borrow') }}">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <button type="submit" class="{{ $book->isAvailable() && !$alreadyBorrowed ? 'btn-primary' : 'btn-danger' }}" 
                    style="width: 100%;" {{ (!$book->isAvailable() || $alreadyBorrowed) ? 'disabled' : '' }}>
                {{ $alreadyBorrowed ? '📌 Sedang Dipinjam' : ($book->isAvailable() ? '📖 Pinjam Buku' : '❌ Stok Habis') }}
            </button>
        </form>
    </div>
    @endforeach
</div>

@push('scripts')
<script>
    function filterBooks() {
        let search = $('#searchBook').val().toLowerCase();
        $('.book-card').each(function() {
            let title = $(this).find('h3').text().toLowerCase();
            let author = $(this).find('p:first').text().toLowerCase();
            if (title.includes(search) || author.includes(search)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
    
    function loadNotifications() {
        $.get('{{ route("member.notifications") }}', function(data) {
            $('#notifBadge').text(data.length).show();
        });
    }
    
    function showNotifications() {
        $.get('{{ route("member.notifications") }}', function(data) {
            if (data.length === 0) {
                alert('📭 Belum ada notifikasi.');
            } else {
                let msg = '🔔 NOTIFIKASI\n\n';
                data.forEach(n => {
                    msg += `📌 ${n.message} (${new Date(n.created_at).toLocaleString()})\n\n`;
                });
                alert(msg);
            }
        });
    }
    
    loadNotifications();
    setInterval(loadNotifications, 30000);
</script>
@endpush
@endsection