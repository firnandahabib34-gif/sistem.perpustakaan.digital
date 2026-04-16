<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library • Sistem Perpustakaan Digital</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* ========== RESET & BASE ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #fafbfc;
            color: #1a202c;
            line-height: 1.5;
        }

        /* ========== CONTAINER ========== */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* ========== NAVIGATION ========== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            z-index: 100;
            padding: 1rem 0;
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            font-size: 1.5rem;
            color: #2563eb;
            text-decoration: none;
        }

        .logo i {
            font-size: 2rem;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #4b5563;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #2563eb;
        }

        .btn-login {
            background: #2563eb;
            color: white !important;
            padding: 0.6rem 1.5rem;
            border-radius: 100px;
            font-weight: 600 !important;
            transition: all 0.2s !important;
        }

        .btn-login:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.3);
        }

        /* ========== HERO SECTION ========== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #f6f8ff 0%, #f0f3ff 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 70% 50%, rgba(37, 99, 235, 0.03) 0%, transparent 50%);
        }

        .hero-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            padding: 0.5rem 1rem;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: #0f172a;
        }

        .hero-title span {
            color: #2563eb;
            position: relative;
        }

        .hero-title span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background: rgba(37, 99, 235, 0.2);
            z-index: -1;
        }

        .hero-description {
            font-size: 1.1rem;
            color: #4b5563;
            margin-bottom: 2.5rem;
            max-width: 500px;
        }

        .hero-stats {
            display: flex;
            gap: 2.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0f172a;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 100px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: #2563eb;
            border: 2px solid rgba(37, 99, 235, 0.2);
            padding: 1rem 2rem;
            border-radius: 100px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-outline:hover {
            border-color: #2563eb;
            background: rgba(37, 99, 235, 0.05);
        }

        .hero-image {
            position: relative;
        }

        .hero-image img {
            width: 100%;
            animation: float 6s ease-in-out infinite;
            filter: drop-shadow(0 20px 30px rgba(37, 99, 235, 0.15));
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        /* ========== SECTION HEADER ========== */
        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 4rem;
        }

        .section-subtitle {
            color: #2563eb;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 1rem;
        }

        .section-description {
            color: #6b7280;
            font-size: 1.1rem;
        }

        /* ========== FEATURES SECTION ========== */
        .features {
            padding: 6rem 0;
            background: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 1.5rem;
            border: 1px solid #eef2f6;
            transition: all 0.3s;
        }

        .feature-card:hover {
            border-color: #2563eb;
            box-shadow: 0 20px 40px -15px rgba(37, 99, 235, 0.15);
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 3.5rem;
            height: 3.5rem;
            background: #eef2ff;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .feature-icon i {
            font-size: 1.5rem;
            color: #2563eb;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #0f172a;
        }

        .feature-card p {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* ========== ROLES SECTION ========== */
        .roles {
            padding: 6rem 0;
            background: #fafbfc;
        }

        .roles-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .role-card {
            background: white;
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .role-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.25);
        }

        .role-header {
            padding: 2rem;
            text-align: center;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
        }

        .role-header.tu {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
        }

        .role-header i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .role-header h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .role-header p {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .role-features {
            padding: 2rem;
        }

        .role-feature {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            color: #4b5563;
            font-size: 0.95rem;
        }

        .role-feature i {
            color: #10b981;
            font-size: 1rem;
        }

        .btn-role {
            display: block;
            margin: 0 2rem 2rem;
            padding: 0.75rem;
            text-align: center;
            background: #eef2ff;
            color: #2563eb;
            border-radius: 100px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-role:hover {
            background: #2563eb;
            color: white;
        }

        /* ========== TEAM SECTION ========== */
        .team {
            padding: 6rem 0;
            background: white;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .team-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            text-align: center;
            border: 1px solid #eef2f6;
            transition: all 0.3s;
        }

        .team-card:hover {
            border-color: #2563eb;
            box-shadow: 0 20px 40px -15px rgba(37, 99, 235, 0.1);
            transform: translateY(-5px);
        }

        .team-avatar {
            width: 6rem;
            height: 6rem;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2.5rem;
            font-weight: 600;
        }

        .team-card:nth-child(2) .team-avatar {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
        }

        .team-card:nth-child(3) .team-avatar {
            background: linear-gradient(135deg, #059669, #10b981);
        }

        .team-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.25rem;
        }

        .team-role {
            color: #2563eb;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .team-nim {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .team-tasks {
            text-align: left;
            background: #f8fafc;
            padding: 1.25rem;
            border-radius: 1rem;
        }

        .team-tasks h4 {
            font-size: 0.85rem;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
        }

        .team-tasks ul {
            list-style: none;
        }

        .team-tasks li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #4b5563;
            margin-bottom: 0.75rem;
        }

        .team-tasks li i {
            color: #10b981;
            font-size: 0.75rem;
        }

        /* ========== STEPS SECTION ========== */
        .steps {
            padding: 6rem 0;
            background: #fafbfc;
        }

        .steps-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .step-item {
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 3rem;
            height: 3rem;
            background: #2563eb;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin: 0 auto 1.5rem;
        }

        .step-item h3 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: #0f172a;
        }

        .step-item p {
            color: #6b7280;
            font-size: 0.9rem;
        }

        /* ========== CTA SECTION ========== */
        .cta {
            padding: 6rem 0;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            text-align: center;
        }

        .cta-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .cta h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .btn-cta {
            background: white;
            color: #2563eb;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 100px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.2);
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 35px -10px rgba(0, 0, 0, 0.3);
        }

        /* ========== FOOTER ========== */
        .footer {
            background: #0f172a;
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 3rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-logo i {
            color: #2563eb;
        }

        .footer-about p {
            color: #9ca3af;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            width: 2.5rem;
            height: 2.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.2s;
        }

        .social-links a:hover {
            background: #2563eb;
            transform: translateY(-3px);
        }

        .footer h4 {
            font-size: 1rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #2563eb;
        }

        .contact-info {
            list-style: none;
        }

        .contact-info li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #9ca3af;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .contact-info i {
            color: #2563eb;
            width: 1.25rem;
        }

        .footer-bottom {
            max-width: 1280px;
            margin: 3rem auto 0;
            padding: 2rem 2rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #9ca3af;
            font-size: 0.9rem;
        }

        /* ========== LOGIN MODAL ========== */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 2.5rem;
            border-radius: 2rem;
            max-width: 400px;
            width: 90%;
            position: relative;
            animation: modalSlide 0.3s ease;
        }

        @keyframes modalSlide {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 1.5rem;
            color: #9ca3af;
            cursor: pointer;
            transition: color 0.2s;
        }

        .modal-close:hover {
            color: #0f172a;
        }

        .modal-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .modal-header i {
            font-size: 3rem;
            color: #2563eb;
            margin-bottom: 1rem;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            color: #0f172a;
            margin-bottom: 0.25rem;
        }

        .modal-header p {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4b5563;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-group label i {
            color: #2563eb;
            margin-right: 0.5rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2563eb;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-modal {
            width: 100%;
            padding: 1rem;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-modal:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.3);
        }

        .demo-info {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 1rem;
            font-size: 0.85rem;
            color: #4b5563;
        }

        .demo-info i {
            color: #2563eb;
            margin-right: 0.5rem;
        }

        .demo-info p {
            margin: 0.25rem 0;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                padding-top: 4rem;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-stats {
                justify-content: center;
            }

            .hero-buttons {
                justify-content: center;
            }

            .roles-grid,
            .team-grid,
            .steps-container,
            .footer-container {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-book-open"></i>
                <span>E-Library</span>
            </a>
            <div class="nav-links">
                <a href="#home">Beranda</a>
                <a href="#features">Fitur</a>
                <a href="#roles">Peran</a>
                <a href="#team">Tim</a>
                <a href="#contact">Kontak</a>
                <a href="#" class="btn-login" onclick="openModal()">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-container">
            <div>
                <div class="hero-badge">
                    <i class="fas fa-robot"></i>
                    <span>v1.0.0 • Prototype Perpustakaan Digital</span>
                </div>
                <h1 class="hero-title">
                    Solusi Digital untuk<br>Perpustakaan <span>Kampus</span>
                </h1>
                <p class="hero-description">
                    Platform manajemen perpustakaan digital yang memudahkan mahasiswa dan staff 
                    dalam mengelola peminjaman buku secara efisien dan modern.
                </p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">1K+</span>
                        <span class="stat-label">Koleksi Buku</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Mahasiswa</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Staff TU</span>
                    </div>
                </div>
                <div class="hero-buttons">
                    <a href="#" class="btn-primary" onclick="openModal()">
                        <i class="fas fa-rocket"></i>
                        Mulai Sekarang
                    </a>
                    <a href="#team" class="btn-outline">
                        <i class="fas fa-users"></i>
                        Tim Pengembang
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/library-4469240-3747862.png" alt="Library Illustration">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle">FITUR UNGGULAN</div>
                <h2 class="section-title">Kenapa Memilih E-Library?</h2>
                <p class="section-description">
                    Dilengkapi dengan berbagai fitur canggih untuk kemudahan akses perpustakaan
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Pencarian Cepat</h3>
                    <p>Temukan buku yang Anda butuhkan dengan fitur pencarian instan dan filter kategori</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Akses 24/7</h3>
                    <p>Akses perpustakaan kapan saja dan di mana saja melalui perangkat Anda</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Laporan Real-time</h3>
                    <p>Pantau statistik peminjaman secara langsung untuk pengelolaan yang lebih baik</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Notifikasi Otomatis</h3>
                    <p>Dapatkan pengingat jatuh tempo pengembalian buku via sistem</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3>Riwayat Peminjaman</h3>
                    <p>Lihat histori peminjaman buku yang pernah Anda lakukan</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Sistem Aman</h3>
                    <p>Data terjamin aman dengan sistem keamanan dan proteksi berlapis</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Roles Section -->
    <section id="roles" class="roles">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle">DUA PERAN UTAMA</div>
                <h2 class="section-title">Untuk Mahasiswa & Tata Usaha</h2>
                <p class="section-description">
                    Antarmuka yang berbeda sesuai dengan kebutuhan masing-masing pengguna
                </p>
            </div>
            <div class="roles-grid">
                <div class="role-card">
                    <div class="role-header">
                        <i class="fas fa-user-graduate"></i>
                        <h3>Mahasiswa</h3>
                        <p>Akses untuk mahasiswa aktif</p>
                    </div>
                    <div class="role-features">
                        <div class="role-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Mencari dan meminjam buku</span>
                        </div>
                        <div class="role-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Melihat riwayat peminjaman</span>
                        </div>
                        <div class="role-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Filter buku per kategori</span>
                        </div>
                        <div class="role-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Notifikasi jatuh tempo</span>
                        </div>
                    </div>
                    <a href="#" class="btn-role" onclick="openModal('mahasiswa')">
                        <i class="fas fa-sign-in-alt"></i> Login Demo Mahasiswa
                    </a>
                </div>

                <div class="role-card">
                    <div class="role-header tu">
                        <i class="fas fa-user-tie"></i>
                        <h3>Tata Usaha</h3>
                        <p>Akses untuk staff perpustakaan</p>
                    </div>
                    <div class="role-features">
                        <div class="role-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Mengelola koleksi buku</span>
                        </div>
                        <div class="role-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Memproses peminjaman</span>
                        </div>
                        <div class="role-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Melihat laporan statistik</span>
                        </div>
                        <div class="role-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Manajemen anggota</span>
                        </div>
                    </div>
                    <a href="#" class="btn-role" onclick="openModal('tu')">
                        <i class="fas fa-sign-in-alt"></i> Login Demo TU
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="team">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle">TIM PENGEMBANG</div>
                <h2 class="section-title">Dibuat oleh 3 Mahasiswa</h2>
                <p class="section-description">
                    Project prototype sistem perpustakaan digital yang dikembangkan secara kolaboratif
                </p>
            </div>
            <div class="team-grid">
                <div class="team-card">
                    <div class="team-avatar">AF</div>
                    <h3 class="team-name">Aril</h3>
                    <div class="team-role">Project Manager & Frontend</div>
                    <div class="team-nim">NIM: 2021001</div>
                    <div class="team-tasks">
                        <h4>TUGAS & TANGGUNG JAWAB</h4>
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Memimpin jalannya proyek</li>
                            <li><i class="fas fa-check-circle"></i> Membagi tugas tim</li>
                            <li><i class="fas fa-check-circle"></i> Membuat wireframe & desain UI</li>
                            <li><i class="fas fa-check-circle"></i> Pengembangan halaman Login & Dashboard</li>
                            <li><i class="fas fa-check-circle"></i> Integrasi seluruh komponen</li>
                        </ul>
                    </div>
                </div>

                <div class="team-card">
                    <div class="team-avatar">BS</div>
                    <h3 class="team-name">Muas</h3>
                    <div class="team-role">Backend & Database</div>
                    <div class="team-nim">NIM: 2021002</div>
                    <div class="team-tasks">
                        <h4>TUGAS & TANGGUNG JAWAB</h4>
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Mendesain struktur database</li>
                            <li><i class="fas fa-check-circle"></i> Membuat