<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi Karyawan</title>
    <link rel="stylesheet" href="{{asset('assets/css/custom-css/index.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="user-info">
                <div class="avatar">
                    <img src="/api/placeholder/100/100" alt="User Avatar">
                </div>
                <div>
                    <div class="user-name">Hi, {{$user->name}} <span class="user-verified">👋</span></div>
                    <div class="user-position">{{$user->jabatan}} di {{$user->getPerusahaan->Nama}}</div>
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
                <i class="fas fa-umbrella-beach"></i>
                <span>Izin / Cuti</span>
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

        <!-- Date Bar -->
        <div class="date-bar">
            <div><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::now()->format('l, j F Y') }}</div>
            <div>{{$user->getShift->nama_shift}}, {{ \Carbon\Carbon::parse($user->getShift->jam_masuk)->format('H:i') }}
                -
                {{ \Carbon\Carbon::parse($user->getShift->jam_keluar)->format('H:i') }}
            </div>
        </div>

        <!-- Attendance Controls -->
        <div class="attendance-controls">
            <div class="attendance-button fw-bold">
                <i class="fas fa-sign-in-alt"></i>
                <div>Masuk
                    {{ \Carbon\Carbon::parse($user->getAbsensi()->where('jenis_absen', 'Masuk')->first()->waktu_absen ?? '')->format('H:i') }}
                </div>
            </div>
            <div class="attendance-button">
                <i class="fas fa-sign-out-alt"></i>
                <div>Pulang
                    {{ \Carbon\Carbon::parse($user->getAbsensi()->where('jenis_absen', 'Keluar')->first()->waktu_absen ?? '')->format('H:i') }}
                </div>
            </div>
        </div>

        <!-- Monthly Summary -->
        <div class="monthly-summary">
            <div class="summary-title">Rekap Absensi Bulanan</div>
            <div class="summary-date">1 April 2025 - 30 April 2025</div>

            <div class="summary-cards">
                <div class="summary-card">
                    <div class="summary-icon presence">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="summary-label">Hadir</div>
                    <div class="summary-value">
                        <span class="summary-number">23</span>
                        <span class="summary-unit">hari</span>
                        <i class="fas fa-arrow-up trend-up"></i>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon permission">
                        <i class="fas fa-praying-hands"></i>
                    </div>
                    <div class="summary-label">Izin</div>
                    <div class="summary-value">
                        <span class="summary-number">0</span>
                        <span class="summary-unit">hari</span>
                        <i class="fas fa-arrow-up trend-up"></i>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon leave">
                        <i class="fas fa-umbrella-beach"></i>
                    </div>
                    <div class="summary-label">Saldo Cuti</div>
                    <div class="summary-value">
                        <span class="summary-number">0</span>
                        <span class="summary-unit">hari</span>
                        <i class="fas fa-arrow-up trend-up"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Menu -->
        <div class="main-menu-section">
            <div class="section-title">Menu Utama</div>
            <div class="menu-grid">
                <div class="menu-item">
                    <div class="menu-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="menu-label">Izin</div>
                </div>

                <div class="menu-item">
                    <div class="menu-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="menu-label">Lembur</div>
                </div>

                <div class="menu-item">
                    <div class="menu-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="menu-label">Shift</div>
                </div>

                <div class="menu-item">
                    <div class="menu-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="menu-label">Berita</div>
                </div>

                <div class="menu-item">
                    <div class="menu-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="menu-label">Slip Gaji</div>
                </div>
            </div>
        </div>

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
                <div class="nav-icon normal">
                    <i class="fas fa-list-alt"></i>
                </div>
                <div class="nav-label">Data Absensi</div>
            </div>
        </div>


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.getElementById('menuToggle');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const closeMenu = document.querySelector('.close-menu');

            // Open menu
            menuToggle.addEventListener('click', function () {
                dropdownMenu.classList.add('active');
            });

            // Close menu
            closeMenu.addEventListener('click', function () {
                dropdownMenu.classList.remove('active');
            });
        });
    </script>
</body>

</html>