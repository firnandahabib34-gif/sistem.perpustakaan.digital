@extends('layouts.app')

@section('title', 'Kelola Anggota')

@section('content')
<div class="top-bar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div class="page-title">
        <h2>👥 Kelola Anggota</h2>
        <p>Tambah, edit, atau hapus anggota perpustakaan</p>
    </div>
    <button class="btn-primary" onclick="openMemberModal()">
        <i class="fas fa-plus"></i> Tambah Anggota
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif

<div class="search-box">
    <input type="text" id="searchMember" placeholder="Cari NIM atau Nama...">
    <button class="btn-primary" onclick="filterMembers()">Cari</button>
</div>

<div class="users-grid" id="membersGrid">
    @foreach($members as $member)
    <div class="user-card">
        <div class="user-avatar" style="margin-bottom: 1rem;">{{ $member->avatar ?? substr($member->name, 0, 2) }}</div>
        <h3>{{ $member->name }}</h3>
        <p><i class="fas fa-id-card"></i> {{ $member->nim }}</p>
        <p><i class="fas fa-envelope"></i> {{ $member->email ?? '-' }}</p>
        <p><i class="fas fa-phone"></i> {{ $member->phone ?? '-' }}</p>
        <div style="margin-top: 1rem;">
            <button class="btn-primary" onclick="editMember('{{ $member->id }}')">✏️ Edit</button>
            <button class="btn-danger" onclick="deleteMember('{{ $member->id }}')">🗑️ Hapus</button>
        </div>
    </div>
    @endforeach
</div>

<div id="memberModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Form Anggota</h3>
        <span onclick="closeMemberModal()" style="float: right; cursor: pointer; font-size: 1.5rem;">&times;</span>
        <form id="memberForm" method="POST">
            @csrf
            <input type="hidden" id="memberId" name="member_id">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" id="nim" name="nim" required>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password">
                <small>Kosongkan jika tidak mengubah password</small>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" id="phone" name="phone">
            </div>
            <button type="submit" class="btn-primary">Simpan</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openMemberModal() {
        $('#modalTitle').text('Tambah Anggota');
        $('#memberForm')[0].reset();
        $('#memberId').val('');
        $('#memberForm').attr('action', '{{ route("admin.members.store") }}');
        $('#memberModal').fadeIn();
    }
    
    function editMember(id) {
        $.get(`/admin/members/${id}/edit`, function(member) {
            $('#modalTitle').text('Edit Anggota');
            $('#memberId').val(member.id);
            $('#nim').val(member.nim);
            $('#name').val(member.name);
            $('#email').val(member.email);
            $('#phone').val(member.phone);
            $('#password').val('');
            $('#memberForm').attr('action', `/admin/members/${id}`);
            $('#memberModal').fadeIn();
        });
    }
    
    function deleteMember(id) {
        if (confirm('Yakin hapus anggota ini?')) {
            $.ajax({
                url: `/admin/members/${id}`,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function() {
                    location.reload();
                }
            });
        }
    }
    
    function filterMembers() {
        let search = $('#searchMember').val().toLowerCase();
        $('.user-card').each(function() {
            let nim = $(this).find('p:first').text().toLowerCase();
            let name = $(this).find('h3').text().toLowerCase();
            if (nim.includes(search) || name.includes(search)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
    
    function closeMemberModal() {
        $('#memberModal').fadeOut();
    }
    
    $('#memberForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).find('#memberId').val() ? 'PUT' : 'POST',
            data: $(this).serialize(),
            success: function() {
                location.reload();
            }
        });
    });
</script>
@endpush
@endsection