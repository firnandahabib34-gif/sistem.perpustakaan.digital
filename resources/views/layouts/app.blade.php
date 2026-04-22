<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Library Pro - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; color: #0f172a; }
        :root { --primary: #3b82f6; --primary-dark: #2563eb; --secondary: #10b981; --danger: #ef4444; --warning: #f59e0b; --gray: #64748b; --light-gray: #e2e8f0; }
        
        .dashboard { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: white; border-right: 1px solid var(--light-gray); position: fixed; height: 100vh; overflow-y: auto; transition: all 0.3s; z-index: 10; }
        .main-content { flex: 1; margin-left: 280px; padding: 1.75rem 2rem; }
        
        .sidebar-header { padding: 1.5rem; border-bottom: 1px solid var(--light-gray); }
        .logo { display: flex; align-items: center; gap: 0.75rem; font-size: 1.3rem; font-weight: 800; color: var(--primary); }
        .user-info-sidebar { margin-top: 1.5rem; display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: #f8fafc; border-radius: 1rem; }
        .user-avatar { width: 44px; height: 44px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-weight: 700; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 5px solid var(--primary); }
        .stat-card i { font-size: 2rem; color: var(--primary); }
        .stat-card h3 { font-size: 1.8rem; font-weight: 800; margin-top: 0.5rem; }
        
        .books-grid, .loans-grid, .users-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 1.5rem; margin-top: 1rem; }
        .book-card, .loan-card, .user-card { background: white; border-radius: 1.5rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.2s; border: 1px solid var(--light-gray); }
        .book-card:hover, .user-card:hover { transform: translateY(-3px); border-color: var(--primary); }
        
        .btn-primary, .btn-danger, .btn-success { padding: 0.6rem 1.2rem; border: none; border-radius: 1rem; font-weight: 600; cursor: pointer; transition: all 0.2s; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-danger { background: var(--danger); color: white; }
        .btn-success { background: var(--secondary); color: white; }
        
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); justify-content: center; align-items: center; z-index: 1000; }
        .modal-content { background: white; border-radius: 1.5rem; width: 90%; max-width: 500px; max-height: 85vh; overflow-y: auto; padding: 1.8rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.85rem; }
        .form-group input, .form-group select { width: 100%; padding: 0.7rem; border: 1px solid var(--light-gray); border-radius: 0.8rem; font-family: inherit; }
        
        .search-box { display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
        .search-box input { flex: 1; padding: 0.8rem; border: 1px solid var(--light-gray); border-radius: 1rem; }
        
        .notification-bell { position: relative; cursor: pointer; background: white; border-radius: 2rem; padding: 0.5rem 1rem; border: 1px solid var(--light-gray); display: inline-flex; align-items: center; gap: 8px; }
        .badge-notif { position: absolute; top: -8px; right: -8px; background: var(--danger); color: white; border-radius: 50%; padding: 0.2rem 0.5rem; font-size: 0.7rem; min-width: 20px; text-align: center; }
        
        .alert { padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        
        @media (max-width: 768px) { .sidebar { width: 80px; } .sidebar .logo span, .sidebar .user-details, .sidebar .menu-label { display: none; } .main-content { margin-left: 80px; } }
    </style>
    @stack('styles')
</head>
<body>
    <div class="dashboard">
        @auth
        <div class="sidebar">
            @if(auth()->user()->isAdmin())
                @include('layouts.admin-sidebar')
            @else
                @include('layouts.member-sidebar')
            @endif
        </div>
        @endauth
        
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>