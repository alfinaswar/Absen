<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Form Pengajuan Cuti</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
        }

        .back-button {
            cursor: pointer;
            padding: 5px;
        }

        .title {
            font-weight: 600;
            font-size: 18px;
        }

        .header-icons {
            display: flex;
            gap: 15px;
        }

        .notification-icon,
        .menu-icon {
            cursor: pointer;
            padding: 5px;
        }

        .page-body {
            padding: 15px;
            background: #f8fafc;
            min-height: calc(100vh - 70px);
            padding-bottom: 100px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1f2937;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 500;
            font-size: 14px;
            color: #374151;
            margin-bottom: 8px;
        }

        .required {
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .form-control:invalid {
            border-color: #ef4444;
        }

        .form-select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: border-color 0.2s;
            box-sizing: border-box;
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .form-textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: border-color 0.2s;
            box-sizing: border-box;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 10px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 10px;
        }

        .info-card {
            background: #f0f9ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .info-card-title {
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card-text {
            color: #1e40af;
            font-size: 14px;
            line-height: 1.5;
        }

        .floating-buttons {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            max-width: 400px;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }

        .btn-secondary {
            flex: 1;
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: #4b5563;
            transform: translateY(-1px);
        }

        .btn-primary {
            flex: 2;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            transition: all 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4);
        }

        .btn-primary:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .form-help {
            font-size: 12px;
            color: #6b7280;
            margin-top: 5px;
        }

        .error-message {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .date-range-display {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            margin-top: 10px;
            display: none;
        }

        .date-range-text {
            font-weight: 500;
            color: #374151;
            margin-bottom: 5px;
        }

        .date-range-duration {
            color: #6b7280;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .col-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="back-button" onclick="history.back()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="#000" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </div>
        <div class="title">Form Pengajuan Cuti</div>
        <div class="header-icons">
            <div class="notification-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" stroke="#000" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M13.73 21a2 2 0 0 1-3.46 0" stroke="#000" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12h18M3 6h18M3 18h18" stroke="#000" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
        </div>
    </div>

    <div class="page-body">
        <!-- Info Card -->
        <div class="info-card">
            <div class="info-card-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                    <path d="M12 16V12M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                Sisa Saldo Cuti Anda
            </div>
            <div class="info-card-text">
                Anda memiliki <strong id="saldo-display">12 hari</strong> sisa cuti untuk tahun ini.
                Pastikan untuk merencanakan cuti Anda dengan baik.
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Detail Pengajuan Cuti</h3>

                <form id="cutiForm" action="{{ route('absen.SimpanCuti') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="jenis_cuti" class="form-label">Jenis Cuti <span class="required">*</span></label>
                        <select id="jenis_cuti" name="jenis_cuti" class="form-select" required>
                            <option value="">Pilih jenis cuti</option>
                            @foreach ($jenis as $item)
                                <option value="{{ $item->Kode }}">{{ $item->Nama }}</option>
                            @endforeach
                        </select>
                        <div class="error-message" id="error-jenis-cuti">Silakan pilih jenis cuti</div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span
                                        class="required">*</span></label>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                                    required>
                                <div class="error-message" id="error-tanggal-mulai">Tanggal mulai harus diisi</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span
                                        class="required">*</span></label>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control"
                                    required>
                                <div class="error-message" id="error-tanggal-selesai">Tanggal selesai harus diisi
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="date-range-display" id="date-range-display">
                        <div class="date-range-text" id="date-range-text"></div>
                        <div class="date-range-duration" id="date-range-duration"></div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan/Alasan <span
                                class="required">*</span></label>
                        <textarea id="keterangan" name="keterangan" class="form-textarea"
                            placeholder="Jelaskan alasan pengajuan cuti Anda..." required></textarea>
                        <div class="form-help">Minimal 10 karakter</div>
                        <div class="error-message" id="error-keterangan">Keterangan minimal 10 karakter</div>
                    </div>

                    <div class="form-group">
                        <label for="pengganti" class="form-label">Penanggung Jawab Pengganti</label>
                        <select id="pengganti" name="pengganti" class="form-select">
                            <option value="">Pilih penanggung jawab (opsional)</option>
                            <option value="john_doe">John Doe - Manager</option>
                            <option value="jane_smith">Jane Smith - Senior Staff</option>
                            <option value="ahmad_ali">Ahmad Ali - Team Lead</option>
                            <option value="siti_nurhaliza">Siti Nurhaliza - Supervisor</option>
                        </select>
                        <div class="form-help">Pilih rekan kerja yang akan menggantikan tugas Anda selama cuti</div>
                    </div>

                    <div class="form-group">
                        <label for="file_upload" class="form-label">Upload File</label>
                        <input type="file" id="file_upload" name="file_upload" class="form-control">
                        <div class="form-help">Upload file yang relevan dengan pengajuan cuti Anda</div>
                    </div>

                    <!-- Tambahkan tombol di dalam form -->
                    <div class="floating-buttons">
                        <button type="button" class="btn-secondary" onclick="resetForm()">
                            Reset
                        </button>
                        <button type="submit" class="btn-primary" id="submit-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                style="display: inline-block; margin-right: 6px; vertical-align: middle;">
                                <path
                                    d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.7088 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4905 2.02168 11.3363C2.16356 9.18203 2.99721 7.13214 4.39828 5.49883C5.79935 3.86553 7.69279 2.72636 9.79619 2.24335C11.8996 1.76034 14.1003 1.95578 16.07 2.81"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Ajukan Cuti
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Floating Action Buttons -->

</body>

</html>
