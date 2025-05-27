@extends('layouts.app_karyawan')
@section('content')
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/custom-css/index.css') }}">
    @endpush


    <!-- Date Bar -->
    <div class="date-bar">
        <div><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::now()->format('l, j F Y') }}</div>
        <div>{{ $user->getShift->nama_shift }}, {{ \Carbon\Carbon::parse($user->getShift->jam_masuk)->format('H:i') }}
            -
            {{ \Carbon\Carbon::parse($user->getShift->jam_keluar)->format('H:i') }}
        </div>
    </div>
    <!-- Attendance Controls -->
    <div class="attendance-controls">
        <div class="attendance-button fw-bold">
            <i class="fas fa-sign-in-alt"></i>
            <div>Masuk
                {{ \Carbon\Carbon::parse($user->getAbsensi->first()->waktu_absen ?? '')->format('H:i') }}
            </div>
        </div>
        <div class="attendance-button">
            <i class="fas fa-sign-out-alt"></i>
            <div>Pulang
                {{ \Carbon\Carbon::parse($user->getAbsensi->last()->waktu_absen ?? '')->format('H:i') }}
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
@endsection