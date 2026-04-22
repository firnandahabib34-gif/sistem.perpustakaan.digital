<div class="sidebar-header">
    <div class="logo">
        <i class="fas fa-chalkboard-user"></i>
        <span>Admin Panel</span>
    </div>
    <div class="user-info-sidebar">
        <div class="user-avatar">{{ auth()->user()->avatar ?? 'AD' }}</div>
        <div class="user-details">
            <div class="user-name">{{ auth()->user()->name }}</div>
            <span class="user-role-badge">Administrator</span>
        </div>
    </div>
</div>
<div class="sidebar-menu" style="padding: 1.5rem;">
    <div class="menu-label">MAIN MENU</div>
    <a href="{{ route('admin.dashboard') }}" class="menu-item" style="display: flex; align-items: center; gap: 0.85rem; padding: 0.7rem 1rem; color: var(--gray); text-decoration: none; margin-bottom: 0.35rem;">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a href="{{ route('admin.books') }}" class="menu-item" style="display: flex; align-items: center; gap: 0.85rem; padding: 0.7rem 1rem; color: var(--gray); text-decoration: none; margin-bottom: 0.35rem;">
        <i class="fas fa-book"></i> Kelola Buku
    </a>
    <a href="{{ route('admin.members') }}" class="menu-item" style="display: flex; align-items: center; gap: 0.85rem; padding: 0.7rem 1rem; color: var(--gray); text-decoration: none; margin-bottom: 0.35rem;">
        <i class="fas fa-users"></i> Kelola Anggota
    </a>
    <a href="{{ route('admin.active-loans') }}" class="menu-item" style="display: flex; align-items: center; gap: 0.85rem; padding: 0.7rem 1rem; color: var(--gray); text-decoration: none; margin-bottom: 0.35rem;">
        <i class="fas fa-hand-holding-heart"></i> Peminjaman Aktif
    </a>
    <a href="{{ route('admin.returns') }}" class="menu-item" style="display: flex; align-items: center; gap: 0.85rem; padding: 0.7rem 1rem; color: var(--gray); text-decoration: none; margin-bottom: 0.35rem;">
        <i class="fas fa-undo-alt"></i> Pengembalian
    </a>
    <div class="menu-label">LAINNYA</div>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-item" style="display: flex; align-items: center; gap: 0.85rem; padding: 0.7rem 1rem; color: var(--gray); text-decoration: none;">
        <i class="fas fa-sign-out-alt"></i> Keluar
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>