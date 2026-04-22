@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="top-bar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div class="page-title">
        <h2>Dashboard Admin</h2>
        <p>Selamat datang, {{ auth()->user()->name }}</p>
    </div>
    <div class="notification-bell" onclick="showNotifications()">
        <i class="fa-regular fa-bell"></i> Notifikasi
        <span id="notifBadge" class="badge-notif">0</span>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <i class="fas fa-book"></i>
        <h3>{{ $totalBooks }}</h3>
        <p>Judul Buku</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-layer-group"></i>
        <h3>{{ $totalStock }}</h3>
        <p>Total Stok</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-users"></i>
        <h3>{{ $totalMembers }}</h3>
        <p>Anggota Aktif</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-clock"></i>
        <h3>{{ $activeLoans }}</h3>
        <p>Peminjaman Aktif</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-money-bill-wave"></i>
        <h3>Rp{{ number_format($totalFine) }}</h3>
        <p>Total Denda</p>
    </div>
</div>

<div class="chart-container" style="background: white; border-radius: 1.5rem; padding: 1.2rem; margin-bottom: 2rem;">
    <canvas id="categoryChart"></canvas>
</div>

<div style="background: white; border-radius: 1.5rem; padding: 1.5rem;">
    <h3>📌 Aktivitas Terbaru</h3>
    <div class="loans-grid">
        @foreach($recentLoans as $loan)
        <div class="loan-card">
            <strong>{{ $loan->book->title }}</strong><br>
            {{ $loan->user->name }}<br>
            Status: {{ $loan->status == 'borrowed' ? 'Dipinjam' : ($loan->status == 'late' ? 'Terlambat' : 'Dikembalikan') }}
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    const ctx = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($categoryStats->pluck('category')) !!},
            datasets: [{
                label: 'Stok Buku',
                data: {!! json_encode($categoryStats->pluck('total')) !!},
                backgroundColor: '#3b82f6',
                borderRadius: 8
            }]
        }
    });
    
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