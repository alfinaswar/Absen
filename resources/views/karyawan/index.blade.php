<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4a5568;
            --secondary-color: #2d3748;
            --accent-color: #3182ce;
            --success-color: #38a169;
            --bg-light: #f7fafc;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-light);
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .top-nav {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .top-nav .profile-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .profile-info {
            display: flex;
            align-items: center;
            color: white;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, #ff6b6b, #feca57);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-weight: bold;
        }

        .profile-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .profile-role {
            font-size: 12px;
            opacity: 0.8;
        }

        .nav-icons {
            display: flex;
            gap: 15px;
        }

        .nav-icons i {
            color: white;
            font-size: 20px;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .nav-icons i:hover {
            opacity: 0.7;
        }

        .schedule-card {
            background: var(--accent-color);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 4px 15px rgba(49, 130, 206, 0.3);
        }

        .schedule-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .schedule-date {
            font-size: 14px;
            font-weight: 500;
        }

        .schedule-time {
            font-size: 12px;
            opacity: 0.9;
        }

        .schedule-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .schedule-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .schedule-icon {
            font-size: 18px;
        }

        .schedule-text {
            font-size: 14px;
            font-weight: 500;
        }

        .attendance-summary {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .summary-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .summary-date {
            font-size: 12px;
            color: #718096;
            margin-bottom: 20px;
        }

        .summary-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            background: #f8f9fa;
            border: 1px solid #e2e8f0;
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: var(--secondary-color);
            display: block;
        }

        .stat-label {
            font-size: 12px;
            color: #718096;
            margin-top: 5px;
        }

        .stat-unit {
            font-size: 14px;
            color: #718096;
        }

        .menu-grid {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .menu-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .menu-items {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
        }

        .menu-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px 10px;
            border-radius: 10px;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .menu-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            color: white;
            text-decoration: none;
        }

        .menu-icon {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .menu-label {
            font-size: 11px;
            text-align: center;
            font-weight: 500;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #e2e8f0;
            z-index: 1000;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .bottom-nav-items {
            display: flex;
            justify-content: space-around;
            padding: 15px 0;
        }

        .bottom-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #718096;
            transition: color 0.3s;
            cursor: pointer;
        }

        .bottom-nav-item.active {
            color: var(--accent-color);
        }

        .bottom-nav-item:hover {
            color: var(--accent-color);
            text-decoration: none;
        }

        .bottom-nav-icon {
            font-size: 22px;
            margin-bottom: 4px;
        }

        .bottom-nav-label {
            font-size: 11px;
            font-weight: 500;
        }

        .fingerprint-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        /* Slide Menu */
        .slide-menu {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: white;
            z-index: 1100;
            transform: translateY(-100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            max-height: 100vh;
            overflow-y: auto;
        }

        .slide-menu.active {
            transform: translateY(0);
        }

        .slide-menu-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 60px 20px 20px;
            color: white;
            position: relative;
        }

        .slide-menu-close {
            position: absolute;
            bottom: 15px;
            right: 20px;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }

        .slide-menu-close:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .slide-menu-title {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .slide-menu-content {
            padding: 0;
        }

        .menu-item-slide {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            color: var(--secondary-color);
            text-decoration: none;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.3s, transform 0.2s;
            cursor: pointer;
        }

        .menu-item-slide:hover {
            background-color: #f8f9fa;
            color: var(--accent-color);
            text-decoration: none;
            transform: translateX(5px);
        }

        .menu-item-slide:first-child {
            background: var(--accent-color);
            color: white;
            font-weight: 600;
        }

        .menu-item-slide:first-child:hover {
            background: var(--accent-color);
            color: white;
            transform: none;
        }

        .menu-item-icon {
            font-size: 18px;
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        .menu-item-text {
            font-size: 16px;
            font-weight: 500;
        }

        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s, visibility 0.4s;
        }

        .menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .menu-items {
                grid-template-columns: repeat(5, 1fr);
                gap: 10px;
            }

            .menu-item {
                padding: 12px 8px;
            }

            .menu-icon {
                font-size: 20px;
            }

            .menu-label {
                font-size: 10px;
            }

            .summary-stats {
                gap: 10px;
            }

            .stat-item {
                padding: 12px;
            }

            .stat-number {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .profile-name {
                font-size: 14px;
            }

            .profile-role {
                font-size: 11px;
            }

            .schedule-card {
                padding: 15px;
            }

            .attendance-summary,
            .menu-grid {
                padding: 15px;
            }

            .summary-title,
            .menu-title {
                font-size: 16px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 480px;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <!-- Top Navigation -->
    <div class="top-nav">
        <div class="container">
            <div class="profile-section">
                <div class="profile-info">
                    <div class="profile-avatar">👋</div>
                    <div>
                        <div class="profile-name">Hi, {{ auth()->user()->name }}</div>
                        <div class="profile-role">{{ auth()->user()->jabatan }} di
                            {{ $user->getPerusahaan->Nama }}
                        </div>
                    </div>
                </div>
                <div class="nav-icons">
                    <i class="fas fa-bell"></i>
                    <i class="fas fa-bars" id="hamburger-menu"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Schedule Card -->
        @php
            use Carbon\Carbon;

            Carbon::setLocale('id');

            $tanggal = Carbon::today();
            $masuk = $user->getAbsensi->where('jenis_absen', 'Masuk')->first();
            $pulang = $user->getAbsensi->where('jenis_absen', 'Pulang')->first();
        @endphp

        <div class="schedule-card">
            <div class="schedule-header">
                <div class="schedule-date">📅 {{ $tanggal->translatedFormat('l, d F Y') }}</div>
                <div class="schedule-time">
                    {{ $user->getShift->nama_shift ?? '-' }},
                    {{ isset($user->getShift->jam_masuk) ? \Carbon\Carbon::parse($user->getShift->jam_masuk)->format('H:i') : '-' }}
                    -
                    {{ isset($user->getShift->jam_keluar) ? \Carbon\Carbon::parse($user->getShift->jam_keluar)->format('H:i') : '-' }}
                </div>
            </div>
            <div class="schedule-content">
                <div class="schedule-item">
                    <i class="fas fa-sign-in-alt schedule-icon"></i>
                    <div>
                        <div class="schedule-text">
                            Masuk

                            {{ isset($masuk->waktu_absen) ? \Carbon\Carbon::parse($masuk->waktu_absen)->format('H:i') : '-' }}
                        </div>
                    </div>
                </div>
                <div class="schedule-item">
                    <i class="fas fa-sign-out-alt schedule-icon"></i>
                    <div>
                        <div class="schedule-text">
                            Pulang
                            {{ isset($pulang->waktu_absen) ? \Carbon\Carbon::parse($pulang->waktu_absen)->format('H:i') : '-' }}
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Attendance Summary -->
        <div class="attendance-summary">
            <div class="summary-title">Rekap Absensi Bulanan</div>
            <div class="summary-date">
                {{ \Carbon\Carbon::parse($user->getPerusahaan->TanggalTutupBuku)->subDays(30)->format('d-m-Y') }} s/d
                {{ \Carbon\Carbon::parse($user->getPerusahaan->TanggalTutupBuku)->format('d-m-Y') }}
            </div>
            <div class="summary-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $jumlahHadir }}</span>
                    <div class="stat-label">Hadir</div>
                    <div class="stat-unit">hari</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $jumlahCuti }}</span>
                    <div class="stat-label">Izin</div>
                    <div class="stat-unit">hari</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ 12 - $jumlahCuti }}</span>
                    <div class="stat-label">Saldo Cuti</div>
                    <div class="stat-unit">hari</div>
                </div>
            </div>
        </div>

        <!-- Menu Grid -->
        <div class="menu-grid">
            <div class="menu-title">Menu Utama</div>
            <div class="menu-items">
                <a href="{{route('absen.TimeOff')}}" class="menu-item">
                    <i class="fas fa-calendar-check menu-icon"></i>
                    <span class="menu-label">Izin</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-clock menu-icon"></i>
                    <span class="menu-label">Lembur</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-exchange-alt menu-icon"></i>
                    <span class="menu-label">Shift</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-file-alt menu-icon"></i>
                    <span class="menu-label">Berita</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-dollar-sign menu-icon"></i>
                    <span class="menu-label">Slip Gaji</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Slide Menu Overlay -->
    <div class="menu-overlay" id="menu-overlay"></div>

    <!-- Slide Menu -->
    <div class="slide-menu" id="slide-menu">
        <div class="slide-menu-header">
            <h2 class="slide-menu-title">Home</h2>
            <button class="slide-menu-close" id="close-menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="slide-menu-content">
            <a href="#" class="menu-item-slide">
                <i class="fas fa-home menu-item-icon"></i>
                <span class="menu-item-text">Home</span>
            </a>
            <a href="#" class="menu-item-slide">
                <i class="fas fa-fingerprint menu-item-icon"></i>
                <span class="menu-item-text">📱 Absensi</span>
            </a>
            <a href="#" class="menu-item-slide">
                <i class="fas fa-umbrella menu-item-icon"></i>
                <span class="menu-item-text">🏖️ Izin / Cuti</span>
            </a>
            <a href="#" class="menu-item-slide">
                <i class="fas fa-history menu-item-icon"></i>
                <span class="menu-item-text">📊 Riwayat</span>
            </a>
            <a href="#" class="menu-item-slide">
                <i class="fas fa-calendar-alt menu-item-icon"></i>
                <span class="menu-item-text">📅 Kalender Kerja</span>
            </a>
            <a href="#" class="menu-item-slide">
                <i class="fas fa-user-cog menu-item-icon"></i>
                <span class="menu-item-text">👤 Pengaturan Akun</span>
            </a>
            <a href="#" class="menu-item-slide">
                <i class="fas fa-phone menu-item-icon"></i>
                <span class="menu-item-text">📞 Bantuan Kontak HR</span>
            </a>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="bottom-nav-items">
            <a href="#" class="bottom-nav-item">
                <i class="fas fa-home bottom-nav-icon"></i>
                <span class="bottom-nav-label">Home</span>
            </a>
            <a href="{{ route('absen.PageAbsen') }}" class="bottom-nav-item active">
                <div class="fingerprint-icon">
                    <i class="fas fa-fingerprint"></i>
                </div>
                <span class="bottom-nav-label">Absensi</span>
            </a>
            <a href="{{ route('absen.RiwayatAbsen') }}" class="bottom-nav-item">
                <i class="fas fa-chart-bar bottom-nav-icon"></i>
                <span class="bottom-nav-label">Data Absensi</span>
            </a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add click effects and interactions
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function (e) {
                // e.preventDefault();
                // Add ripple effect
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-2px)';
                }, 150);
            });
        });

        document.querySelectorAll('.bottom-nav-item').forEach(item => {
            item.addEventListener('click', function (e) {
                // e.preventDefault();
                // Remove active class from all items
                document.querySelectorAll('.bottom-nav-item').forEach(nav => nav.classList.remove(
                    'active'));
                // Add active class to clicked item
                this.classList.add('active');
            });
        });

        // Add notification bell animation
        document.querySelector('.fa-bell').addEventListener('click', function () {
            this.style.animation = 'shake 0.5s';
            setTimeout(() => {
                this.style.animation = '';
            }, 500);
        });

        // Hamburger menu functionality
        const hamburgerMenu = document.getElementById('hamburger-menu');
        const slideMenu = document.getElementById('slide-menu');
        const menuOverlay = document.getElementById('menu-overlay');
        const closeMenu = document.getElementById('close-menu');

        function openSlideMenu() {
            slideMenu.classList.add('active');
            menuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSlideMenu() {
            slideMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        hamburgerMenu.addEventListener('click', openSlideMenu);
        closeMenu.addEventListener('click', closeSlideMenu);
        menuOverlay.addEventListener('click', closeSlideMenu);

        // Close menu with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && slideMenu.classList.contains('active')) {
                closeSlideMenu();
            }
        });

        // Add click effects to slide menu items
        document.querySelectorAll('.menu-item-slide').forEach(item => {
            item.addEventListener('click', function (e) {
                // e.preventDefault();
                // Add click effect
                this.style.transform = 'translateX(10px)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            });
        });

        // Add CSS for shake animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: rotate(0deg); }
                25% { transform: rotate(-10deg); }
                75% { transform: rotate(10deg); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>