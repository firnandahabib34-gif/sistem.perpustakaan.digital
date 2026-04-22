@extends('layouts.app')

@section('title', 'Kelola Buku')

@section('content')
<div class="top-bar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div class="page-title">
        <h2>📚 Kelola Buku</h2>
        <p>Tambah, edit, atau hapus koleksi buku</p>
    </div>
    <button class="btn-primary" onclick="openBookModal()">
        <i class="fas fa-plus"></i> Tambah Buku
    </button>
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
    <div class="book-card">
        <h3>{{ $book->title }}</h3>
        <p><i class="fas fa-user-edit"></i> {{ $book->author }}</p>
        <p><i class="fas fa-tag"></i> {{ $book->category }} | 📦 Stok: {{ $book->stock }} | 📅 {{ $book->year }}</p>
        <div style="margin-top: 1rem;">
            <button class="btn-primary" onclick="editBook({{ $book->id }})">✏️ Edit</button>
            <button class="btn-danger" onclick="deleteBook({{ $book->id }})">🗑️ Hapus</button>
        </div>
    </div>
    @endforeach
</div>

<div id="bookModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Form Buku</h3>
        <span onclick="closeBookModal()" style="float: right; cursor: pointer; font-size: 1.5rem;">&times;</span>
        <form id="bookForm" method="POST">
            @csrf
            <input type="hidden" id="bookId" name="book_id">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label>Penulis</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select id="category" name="category">
                    <option>Teknologi</option>
                    <option>Matematika</option>
                    <option>Fisika</option>
                    <option>Kimia</option>
                </select>
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="number" id="stock" name="stock" required>
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="text" id="year" name="year">
            </div>
            <button type="submit" class="btn-primary">Simpan</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openBookModal() {
        $('#modalTitle').text('Tambah Buku');
        $('#bookForm')[0].reset();
        $('#bookId').val('');
        $('#bookForm').attr('action', '{{ route("admin.books.store") }}');
        $('#bookModal').fadeIn();
    }
    
    function editBook(id) {
        $.get(`/admin/books/${id}/edit`, function(book) {
            $('#modalTitle').text('Edit Buku');
            $('#bookId').val(book.id);
            $('#title').val(book.title);
            $('#author').val(book.author);
            $('#category').val(book.category);
            $('#stock').val(book.stock);
            $('#year').val(book.year);
            $('#bookForm').attr('action', `/admin/books/${id}`);
            $('#bookModal').fadeIn();
        });
    }
    
    function deleteBook(id) {
        if (confirm('Yakin hapus buku ini?')) {
            $.ajax({
                url: `/admin/books/${id}`,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function() {
                    location.reload();
                }
            });
        }
    }
    
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
    
    function closeBookModal() {
        $('#bookModal').fadeOut();
    }
    
    $('#bookForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).find('#bookId').val() ? 'PUT' : 'POST',
            data: $(this).serialize(),
            success: function() {
                location.reload();
            }
        });
    });
</script>
@endpush
@endsection