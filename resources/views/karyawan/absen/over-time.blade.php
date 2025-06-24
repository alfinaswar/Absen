<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Cuti - Aplikasi Absensi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4a5568;
            --secondary-color: #2d3748;
            --accent-color: #3182ce;
            --success-color: #38a169;
            --warning-color: #dd6b20;
            --danger-color: #e53e3e;
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

        .nav-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }

        .nav-back {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .nav-back:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .nav-action {
            width: 36px;
            /* Placeholder untuk symmetry */
        }

        .form-container {
            background: white;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, var(--accent-color), #4299e1);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .form-header-icon {
            font-size: 40px;
            margin-bottom: 10px;
            display: block;
        }

        .form-header-title {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .form-header-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px;
        }

        .form-content {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 8px;
        }

        .form-label.required::after {
            content: ' *';
            color: var(--danger-color);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .date-range-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .info-card {
            background: #f8f9fa;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .info-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .info-card-icon {
            font-size: 18px;
            color: var(--accent-color);
            margin-right: 10px;
        }

        .info-card-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--secondary-color);
            margin: 0;
        }

        .info-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .info-stat {
            text-align: center;
            padding: 10px;
            background: white;
            border-radius: 8px;
        }

        .info-stat-number {
            font-size: 18px;
            font-weight: bold;
            color: var(--secondary-color);
            display: block;
        }

        .info-stat-label {
            font-size: 11px;
            color: #718096;
            margin-top: 2px;
        }

        .attachment-area {
            border: 2px dashed #cbd5e0;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            transition: border-color 0.3s, background-color 0.3s;
            cursor: pointer;
        }

        .attachment-area:hover {
            border-color: var(--accent-color);
            background-color: rgba(49, 130, 206, 0.02);
        }

        .attachment-area.dragover {
            border-color: var(--accent-color);
            background-color: rgba(49, 130, 206, 0.05);
        }

        .attachment-icon {
            font-size: 32px;
            color: #a0aec0;
            margin-bottom: 10px;
        }

        .attachment-text {
            color: #718096;
            font-size: 14px;
        }

        .attachment-subtext {
            color: #a0aec0;
            font-size: 12px;
            margin-top: 5px;
        }

        .file-input {
            display: none;
        }

        .uploaded-files {
            margin-top: 15px;
        }

        .uploaded-file {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 8px;
        }

        .uploaded-file-info {
            display: flex;
            align-items: center;
        }

        .uploaded-file-icon {
            font-size: 18px;
            color: var(--accent-color);
            margin-right: 10px;
        }

        .uploaded-file-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--secondary-color);
        }

        .uploaded-file-size {
            font-size: 12px;
            color: #718096;
        }

        .remove-file {
            background: none;
            border: none;
            color: var(--danger-color);
            font-size: 16px;
            cursor: pointer;
            padding: 4px;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .remove-file:hover {
            background-color: rgba(229, 62, 62, 0.1);
        }

        .form-actions {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 15px 25px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-secondary {
            background: #f7fafc;
            color: var(--secondary-color);
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #edf2f7;
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-color), #4299e1);
            color: white;
            box-shadow: 0 4px 15px rgba(49, 130, 206, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(49, 130, 206, 0.4);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-info {
            background: rgba(49, 130, 206, 0.1);
            color: var(--accent-color);
            border-left: 4px solid var(--accent-color);
        }

        .alert-warning {
            background: rgba(221, 107, 32, 0.1);
            color: var(--warning-color);
            border-left: 4px solid var(--warning-color);
        }

        /* Loading State */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            color: white;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .date-range-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .form-actions {
                grid-template-columns: 1fr;
            }

            .info-stats {
                gap: 8px;
            }

            .info-stat {
                padding: 8px;
            }

            .info-stat-number {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .form-content {
                padding: 20px;
            }

            .form-header {
                padding: 15px;
            }

            .form-header-icon {
                font-size: 32px;
            }

            .form-header-title {
                font-size: 18px;
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
            <div class="nav-header">

                <a href="{{ route('home') }}" class="nav-back"><i class="fas fa-arrow-left"></i>
                </a>

                <h1 class="nav-title">Absensi Lembur</h1>
                <div class="nav-action"></div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Form Container -->
        <div class="form-container">
            <!-- Form Header -->
            <div class="form-header">
                <i class="fas fa-clock form-header-icon"></i>
                <h2 class="form-header-title">Absensi Lembur</h2>
                <p class="form-header-subtitle">Isi formulir dengan lengkap dan benar</p>
            </div>

            <!-- Form Content -->
            <div class="form-content">
                <!-- Info Card -->


                <!-- Alert -->
                @if (session('success'))
                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb"></i>
                        Berhasil !, Absensi Lembur Akan Di Cek Kembali Oleh HR
                    </div>
                @endif


                <!-- Form -->
                <form id="overtimeForm" enctype="multipart/form-data" method="POST"
                    action="{{ route('absen.SimpanLembur') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label required">Tanggal</label>
                        <input type="date" class="form-control" id="tanggalOvertime" name="Tanggal" required>
                    </div>

                    <!-- Jam Mulai -->
                    <div class="form-group">
                        <label class="form-label required">Jam Mulai</label>
                        <input type="time" class="form-control" id="jamMulai" name="JamMulai" required>
                    </div>

                    <!-- Jam Selesai -->
                    <div class="form-group">
                        <label class="form-label required">Jam Selesai</label>
                        <input type="time" class="form-control" id="jamSelesai" name="JamSelesai" required>
                    </div>

                    <!-- Durasi (otomatis) -->
                    <div class="form-group">
                        <label class="form-label">Durasi</label>
                        <input type="text" class="form-control" id="durasiOvertime" name="Durasi" readonly
                            placeholder="Akan dihitung otomatis">
                    </div>

                    <!-- Kegiatan -->
                    <div class="form-group">
                        <label class="form-label required">Kegiatan</label>
                        <textarea class="form-control" id="kegiatanOvertime" name="Kegiatan" required
                            placeholder="Jelaskan kegiatan yang dilakukan"></textarea>
                    </div>

                    <!-- Status -->


                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="reset" class="btn btn-secondary" onclick="resetOvertimeForm()">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitOvertimeBtn">
                            <i class="fas fa-paper-plane"></i> Kirim Pengajuan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        const jamMulaiInput = document.getElementById('jamMulai');
        const jamSelesaiInput = document.getElementById('jamSelesai');
        const durasiInput = document.getElementById('durasiOvertime');


        function hitungDurasi() {
            const jamMulai = jamMulaiInput.value;
            const jamSelesai = jamSelesaiInput.value;

            if (jamMulai && jamSelesai) {

                const [startHour, startMinute] = jamMulai.split(':').map(Number);
                const [endHour, endMinute] = jamSelesai.split(':').map(Number);


                let totalMenitAwal = startHour * 60 + startMinute;
                let totalMenitAkhir = endHour * 60 + endMinute;


                if (totalMenitAkhir < totalMenitAwal) {
                    totalMenitAkhir += 24 * 60;
                }

                const selisihMenit = totalMenitAkhir - totalMenitAwal;


                const jam = Math.floor(selisihMenit / 60);
                const menit = selisihMenit % 60;
                durasiInput.value = `${jam} jam ${menit} menit`;
            } else {
                durasiInput.value = '';
            }
        }
        jamMulaiInput.addEventListener('change', hitungDurasi);
        jamSelesaiInput.addEventListener('change', hitungDurasi);

        $(document).ready(function() {
            hitungDurasi()
        });
    </script>
</body>

</html>
