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
                <button class="nav-back" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h1 class="nav-title">Pengajuan Cuti</h1>
                <div class="nav-action"></div>
            </div>
        </div>
    </div>
    {{-- @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif --}}
    <!-- Main Content -->
    <div class="container">
        <!-- Form Container -->
        <div class="form-container">
            <!-- Form Header -->
            <div class="form-header">
                <i class="fas fa-umbrella-beach form-header-icon"></i>
                <h2 class="form-header-title">Pengajuan Cuti</h2>
                <p class="form-header-subtitle">Isi formulir dengan lengkap dan benar</p>
            </div>

            <!-- Form Content -->
            <div class="form-content">
                <!-- Info Card -->
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="fas fa-info-circle info-card-icon"></i>
                        <h3 class="info-card-title">Informasi Cuti Anda</h3>
                    </div>
                    <div class="info-stats">
                        <div class="info-stat">
                            <span class="info-stat-number">12</span>
                            <div class="info-stat-label">Total Cuti</div>
                        </div>
                        <div class="info-stat">
                            <span class="info-stat-number">3</span>
                            <div class="info-stat-label">Terpakai</div>
                        </div>
                        <div class="info-stat">
                            <span class="info-stat-number">9</span>
                            <div class="info-stat-label">Sisa Cuti</div>
                        </div>
                    </div>
                </div>

                <!-- Alert -->
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb"></i>
                    Pengajuan cuti harus diajukan minimal 3 hari sebelum tanggal cuti dimulai.
                </div>

                <!-- Form -->
                <form id="timeOffForm" enctype="multipart/form-data">
                    <!-- Jenis Cuti -->
                    <div class="form-group">
                        <label class="form-label required">Jenis Cuti</label>
                        <select class="form-control form-select" id="jenisCuti" name="JenisCuti" required>
                            <option value="">Pilih jenis cuti</option>
                            @foreach ($jenis as $j)
                                <option value="{{$j->Kode}}">{{$j->Nama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Cuti -->
                    <div class="form-group">
                        <label class="form-label required">Periode Cuti</label>
                        <div class="date-range-container">
                            <div>
                                <label class="form-label" style="font-size: 12px; color: #718096;">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggalMulai" name="TanggalAwal" required>
                            </div>
                            <div>
                                <label class="form-label" style="font-size: 12px; color: #718096;">Tanggal
                                    Selesai</label>
                                <input type="date" class="form-control" id="tanggalSelesai" name="TanggalAkhir"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Durasi Cuti -->
                    <div class="form-group">
                        <label class="form-label">Durasi Cuti</label>
                        <input type="text" class="form-control" id="durasiCuti" readonly
                            placeholder="Akan dihitung otomatis" name="Durasi">
                    </div>

                    <!-- Alasan Cuti -->
                    <div class="form-group">
                        <label class="form-label required">Alasan Cuti</label>
                        <textarea class="form-control form-textarea" id="alasanCuti"
                            placeholder="Jelaskan alasan pengajuan cuti Anda" required name="Keterangan"></textarea>
                    </div>



                    <!-- Upload Dokumen -->
                    <div class="form-group">
                        <label class="form-label">Dokumen Pendukung</label>
                        <div class="attachment-area" onclick="document.getElementById('fileInput').click()">
                            <i class="fas fa-cloud-upload-alt attachment-icon"></i>
                            <div class="attachment-text">Klik untuk mengunggah dokumen</div>
                            <div class="attachment-subtext">Format: PDF, JPG, PNG (Max: 5MB)</div>
                        </div>
                        <input type="file" id="fileInput" class="file-input" name="Dokumen"
                            accept=".pdf,.jpg,.jpeg,.png" multiple>
                        <div class="uploaded-files" id="uploadedFiles"></div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">
                            <i class="fas fa-undo"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // File upload handling
        const fileInput = document.getElementById('fileInput');
        const uploadedFilesContainer = document.getElementById('uploadedFiles');
        let uploadedFiles = [];

        fileInput.addEventListener('change', handleFileUpload);

        function handleFileUpload(event) {
            const files = Array.from(event.target.files);

            files.forEach(file => {
                if (file.size > 5 * 1024 * 1024) { // 5MB limit
                    alert(`File ${file.name} terlalu besar. Maksimal 5MB.`);
                    return;
                }

                if (!uploadedFiles.find(f => f.name === file.name)) {
                    uploadedFiles.push(file);
                    displayUploadedFile(file);
                }
            });

            // Reset input
            event.target.value = '';
        }

        function displayUploadedFile(file) {
            const fileDiv = document.createElement('div');
            fileDiv.className = 'uploaded-file';
            fileDiv.innerHTML = `
                <div class="uploaded-file-info">
                    <i class="fas fa-file-alt uploaded-file-icon"></i>
                    <div>
                        <div class="uploaded-file-name">${file.name}</div>
                        <div class="uploaded-file-size">${formatFileSize(file.size)}</div>
                    </div>
                </div>
                <button type="button" class="remove-file" onclick="removeFile('${file.name}', this)">
                    <i class="fas fa-times"></i>
                </button>
            `;
            uploadedFilesContainer.appendChild(fileDiv);
        }

        function removeFile(fileName, buttonElement) {
            uploadedFiles = uploadedFiles.filter(file => file.name !== fileName);
            buttonElement.closest('.uploaded-file').remove();
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Date calculation
        document.getElementById('tanggalMulai').addEventListener('change', calculateDuration);
        document.getElementById('tanggalSelesai').addEventListener('change', calculateDuration);

        function calculateDuration() {
            const startDate = document.getElementById('tanggalMulai').value;
            const endDate = document.getElementById('tanggalSelesai').value;

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

                if (end >= start) {
                    document.getElementById('durasiCuti').value = `${diffDays} hari`;
                } else {
                    document.getElementById('durasiCuti').value = '';
                    alert('Tanggal selesai harus setelah tanggal mulai');
                }
            }
        }

        // Form submission
        document.getElementById('timeOffForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            const formData = new FormData(this);

            // Tambahkan file yang diupload ke FormData
            uploadedFiles.forEach(file => {
                formData.append('files[]', file);
            });

            fetch('{{ route("absen.SimpanCuti") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Pengajuan cuti berhasil dikirim! Anda akan mendapat notifikasi setelah disetujui atasan.');
                        resetForm();
                    } else {
                        alert(data.message || 'Terjadi kesalahan saat mengirim pengajuan cuti');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim pengajuan cuti');
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        });

        // Form reset
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mengatur ulang formulir?')) {
                document.getElementById('timeOffForm').reset();
                uploadedFiles = [];
                uploadedFilesContainer.innerHTML = '';
                document.getElementById('durasiCuti').value = '';
            }
        }

        // Back navigation
        function goBack() {
            if (confirm('Apakah Anda yakin ingin kembali? Data yang belum disimpan akan hilang.')) {
                window.location.href = '{{ route("home") }}';
            }
        }

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggalMulai').min = today;
        document.getElementById('tanggalSelesai').min = today;

        // Auto-fill phone number from user data (if available)
        // This would typically come from your backend/session data
        // document.getElementById('nomorHP').value = '{{ auth()->user()->phone ?? "" }}';

        // Drag and drop functionality
        const attachmentArea = document.querySelector('.attachment-area');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            attachmentArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            attachmentArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            attachmentArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            attachmentArea.classList.add('dragover');
        }

        function unhighlight(e) {
            attachmentArea.classList.remove('dragover');
        }

        attachmentArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            // Simulate file input change event
            const event = new Event('change');
            Object.defineProperty(event, 'target', {
                value: { files: files },
                enumerable: true
            });

            handleFileUpload(event);
        }
    </script>
</body>

</html>