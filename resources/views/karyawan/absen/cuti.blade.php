<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Cuti</title>
    <style>
        * {
            box-sizing: border-box;
        }

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
            width: 100%;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            overflow: hidden;
            width: 100%;
            max-width: 100%;
        }

        .card-body {
            padding: 20px;
            width: 100%;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1f2937;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        .form-label {
            display: block;
            font-weight: 500;
            font-size: 14px;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-label.required::after {
            content: ' *';
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: all 0.2s;
            box-sizing: border-box;
            max-width: 100%;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: border-color 0.2s;
            cursor: pointer;
            box-sizing: border-box;
            max-width: 100%;
        }

        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .date-input-group {
            display: flex;
            gap: 15px;
            align-items: end;
            width: 100%;
        }

        .date-input-item {
            flex: 1;
            min-width: 0;
        }

        .duration-display {
            background: #f8fafc;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            font-weight: 600;
            color: #3b82f6;
            min-width: 80px;
            box-sizing: border-box;
        }

        .textarea {
            min-height: 100px;
            resize: vertical;
            font-family: inherit;
        }

        .file-upload {
            position: relative;
            display: block;
            width: 100%;
        }

        .file-input {
            width: 100%;
            padding: 40px 12px;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #fafbfc;
            box-sizing: border-box;
        }

        .file-input:hover {
            border-color: #3b82f6;
            background: #f8fafc;
        }

        .file-input.dragover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .file-input-text {
            color: #6b7280;
            font-size: 14px;
        }

        .file-input-subtext {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 5px;
        }

        .file-preview {
            margin-top: 15px;
            padding: 12px;
            background: #f3f4f6;
            border-radius: 8px;
            display: none;
        }

        .file-preview-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .file-icon {
            width: 32px;
            height: 32px;
            background: #3b82f6;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .file-info {
            flex: 1;
        }

        .file-name {
            font-weight: 500;
            font-size: 14px;
            color: #1f2937;
        }

        .file-size {
            font-size: 12px;
            color: #6b7280;
        }

        .file-remove {
            cursor: pointer;
            color: #ef4444;
            padding: 5px;
        }

        .submit-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            width: calc(100% - 40px);
            max-width: 400px;
            margin: 0 auto;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
            transition: all 0.2s;
            z-index: 1000;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(59, 130, 246, 0.4);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .submit-button:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .error-message {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .saldo-info {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            text-align: center;
            padding: 20px;
            margin: -20px -20px 20px -20px;
            border-radius: 12px 12px 0 0;
        }

        .saldo-title {
            font-size: 12px;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .saldo-number {
            font-size: 24px;
            font-weight: 700;
        }

        /* Mobile specific fixes */
        @media (max-width: 768px) {
            .page-body {
                padding: 10px;
            }

            .card-body {
                padding: 15px;
            }

            .date-input-group {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }

            .date-input-item {
                width: 100%;
            }

            .duration-display {
                min-width: auto;
                width: 100%;
            }

            .submit-button {
                left: 15px;
                right: 15px;
                width: calc(100% - 30px);
                max-width: none;
                position: fixed;
                transform: none;
            }

            .submit-button:hover {
                transform: translateY(-2px);
            }

            .header {
                padding: 12px 15px;
            }

            .title {
                font-size: 16px;
            }

            .form-control,
            .form-select {
                font-size: 16px;
                /* Prevents zoom on iOS */
            }
        }

        @media (max-width: 480px) {
            .page-body {
                padding: 8px;
            }

            .card-body {
                padding: 12px;
            }

            .saldo-info {
                margin: -12px -12px 15px -12px;
            }

            .submit-button {
                left: 10px;
                right: 10px;
                width: calc(100% - 20px);
                bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="back-button">←</div>
        <div class="title">Form Pengajuan</div>
        <div class="header-icons">
            <div class="notification-icon">🔔</div>
            <div class="menu-icon">☰</div>
        </div>
    </div>

    <!-- Page Body -->
    <div class="page-body">
        <!-- Saldo Card -->
        <div class="card">
            <div class="card-body">
                <div class="saldo-info">
                    <div class="saldo-title">Saldo Tersedia</div>
                    <div class="saldo-number">Rp 2.500.000</div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-body">
                <div class="card-title">Detail Pengajuan</div>

                <div class="form-group">
                    <label class="form-label required">Nama Lengkap</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                </div>

                <div class="form-group">
                    <label class="form-label required">Jenis Pengajuan</label>
                    <select class="form-select">
                        <option>Pilih jenis pengajuan</option>
                        <option>Cuti Tahunan</option>
                        <option>Cuti Sakit</option>
                        <option>Izin Khusus</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label required">Periode</label>
                    <div class="date-input-group">
                        <div class="date-input-item">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="date-input-item">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="duration-display">
                            3 Hari
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label required">Alasan</label>
                    <textarea class="form-control textarea" placeholder="Jelaskan alasan pengajuan Anda..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Lampiran Dokumen</label>
                    <div class="file-upload">
                        <div class="file-input">
                            <div class="file-input-text">📎 Klik atau drag file ke sini</div>
                            <div class="file-input-subtext">Format: PDF, JPG, PNG (Max 5MB)</div>
                        </div>
                        <div class="file-preview">
                            <div class="file-preview-item">
                                <div class="file-icon">PDF</div>
                                <div class="file-info">
                                    <div class="file-name">dokumen-pendukung.pdf</div>
                                    <div class="file-size">2.1 MB</div>
                                </div>
                                <div class="file-remove">🗑️</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <button class="submit-button">
        Kirim Pengajuan
    </button>

    <script>
        // File upload functionality
        const fileInput = document.querySelector('.file-input');
        const filePreview = document.querySelector('.file-preview');

        fileInput.addEventListener('click', () => {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = '.pdf,.jpg,.jpeg,.png';
            input.onchange = handleFileSelect;
            input.click();
        });

        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                filePreview.style.display = 'block';
                // Update file info in preview
                const fileName = filePreview.querySelector('.file-name');
                const fileSize = filePreview.querySelector('.file-size');
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }

        // Remove file
        document.querySelector('.file-remove').addEventListener('click', () => {
            filePreview.style.display = 'none';
        });

        // Date calculation
        const startDate = document.querySelector('input[type="date"]:first-of-type');
        const endDate = document.querySelector('input[type="date"]:last-of-type');
        const durationDisplay = document.querySelector('.duration-display');

        function calculateDuration() {
            if (startDate.value && endDate.value) {
                const start = new Date(startDate.value);
                const end = new Date(endDate.value);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                durationDisplay.textContent = diffDays + ' Hari';
            }
        }

        startDate.addEventListener('change', calculateDuration);
        endDate.addEventListener('change', calculateDuration);

        // Submit button
        document.querySelector('.submit-button').addEventListener('click', () => {
            alert('Pengajuan berhasil dikirim!');
        });
    </script>
</body>

</html>