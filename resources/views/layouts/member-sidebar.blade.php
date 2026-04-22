<div class="sidebar-header">
    <div class="logo">
        <i class="fas fa-graduation-cap"></i>
        <span>E-Library</span>
    </div>
    <div class="user-info-sidebar">
        <div class="user-avatar">{{ auth()->user()->avatar ?? auth()->user()->name[0] }}</div>
        <div class="user-details">
            <div class="user-name">{{ auth()->user()->name }}</div>
            <span class="user-role-badge">Mahasiswa</span>
        </div>
    </div>
</div>
<div class="sidebar-menu" style="padding: 1.5rem;">
    <div class="menu-label">MENU</div>
    <a href="{{ route('member.dashboard') }}" class="menu-item" style="display: flex; align-items: center; gap: 0.85rem; padding: 0.7rem 1rem; color: var(--gray); text-decoration: none; margin-bottom: 0.35rem;">
        <i class="fas fa-book"></i> Pinjam Buku
    </a>
    <a href="{{ route('member.returns') }}" class="menu-item" style="display: flex; align-items: center; gap: 0.85rem; padding: 0.7rem 1rem; color: var(--gray); text-decoration: none; margin-bottom: 0.35rem;">
        <i class="fas fa-undo-alt"></i> Pengembalian Saya
    </a>
    <a href="{{ route('member.history') }}" class="menu-item" style="display: flex; align-items: center; gap: 0.85rem; padding: 0.7rem 1rem; color: var(--gray); text-decoration: none; margin-bottom: 0.35rem;">
        <i class="fas fa-history"></i> Riwayat & Denda
    </a>
    <div class="menu-label">LAINNYA</div>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-item" style="display: flex; align-items: center; gap: 0.85rem; padding: 0.7rem 1rem; color: var(--gray); text-decoration: none;">
        <i class="fas fa-sign-out-alt"></i> Keluar
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>