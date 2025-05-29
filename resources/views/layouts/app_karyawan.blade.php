<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi Karyawan</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    @stack('css')
</head>

<body>

    <div class="container">
        <div class="header">
            <div class="user-info">
                <div class="avatar">
                    <i class="fas fa-user-circle fa-5x"></i>
                </div>
                <div>
                    <div class="user-name">Hi, {{ $user->name }} <span class="user-verified">👋</span></div>
                    <div class="user-position">{{ $user->jabatan }} di {{ $user->getPerusahaan->Nama }}</div>
                </div>
            </div>
            <div class="header-icons">
                <i class="fas fa-bell icon"></i>
                <i class="fas fa-bars icon" id="menuToggle"></i>
            </div>
        </div>

        <!-- Dropdown Menu -->
        <div class="dropdown-menu" id="dropdownMenu">
            <div class="menu-item active">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-calendar-check"></i>
                <span>Absensi</span>
            </div>
            <div class="menu-item">
                <a href="{{ route('absen.TimeOff') }}">
                    <i class="fas fa-umbrella-beach"></i>
                    <span>Izin / Cuti</span>
                </a>
            </div>
            <div class="menu-item">
                <i class="fas fa-history"></i>
                <span>Riwayat</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Kalender Kerja</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-user-cog"></i>
                <span>Pengaturan Akun</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-headset"></i>
                <span>Bantuan Kontak HR</span>
            </div>
            <div class="close-menu">
                <i class="fas fa-times"></i>
            </div>
        </div>
        @yield('content')
        <div class="nav-spacer"></div>

        <!-- Bottom Navigation -->
        <div class="bottom-nav">
            <div class="nav-item">
                <div class="nav-icon normal">
                    <i class="fas fa-home"></i>
                </div>
                <div class="nav-label active">Home</div>
            </div>

            <div class="nav-item">
                <a href="{{ route('absen.PageAbsen') }}">
                    <div class="nav-icon">
                        <i class="fas fa-fingerprint"></i>
                    </div>
                    <div class="nav-label">Absensi</div>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('absen.RiwayatAbsen') }}">
                    <div class="nav-icon">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <div class="nav-label">Data Absensi</div>
                </a>
            </div>
        </div>
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menuToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const closeMenu = document.querySelector('.close-menu');

        // Open menu
        menuToggle.addEventListener('click', function() {
            dropdownMenu.classList.add('active');
        });

        // Close menu
        closeMenu.addEventListener('click', function() {
            dropdownMenu.classList.remove('active');
        });
    });
</script>
@stack('js')

</html>
