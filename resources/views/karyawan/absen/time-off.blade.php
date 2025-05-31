<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Cuti</title>
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
            margin-bottom: 15px;
            color: #1f2937;
        }

        .saldo-cuti {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            text-align: center;
            padding: 30px 20px;
            margin: -20px -20px 20px -20px;
        }

        .saldo-title {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 8px;
        }

        .saldo-number {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .saldo-subtitle {
            font-size: 12px;
            opacity: 0.8;
        }

        .form-select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: border-color 0.2s;
        }

        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .col-3 {
            flex: 0 0 25%;
            max-width: 25%;
            padding: 10px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 10px;
        }

        .stat-card {
            text-align: center;
            padding: 15px 10px;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .stat-label {
            font-weight: 500;
            font-size: 11px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .date-cell {
            font-weight: 600;
            color: #1f2937;
        }

        .type-cell {
            color: #6b7280;
            font-size: 14px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .loading {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
        }

        .floating-button {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            max-width: 400px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            transition: all 0.2s;
            z-index: 1000;
        }

        .floating-button:hover {
            transform: translateX(-50%) translateY(-2px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4);
        }

        .floating-button:active {
            transform: translateX(-50%) translateY(0);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            opacity: 0.5;
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
        <div class="title">Pengajuan Cuti</div>
        <div class="header-icons">
            <div class="notification-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" stroke="#000" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M13.73 21a2 2 0 0 1-3.46 0" stroke="#000" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12h18M3 6h18M3 18h18" stroke="#000" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
        </div>
    </div>

    <div class="page-body">
        <!-- Saldo Cuti Card -->
        <div class="card">
            <div class="card-body">
                <div class="saldo-cuti">
                    <div class="saldo-title">Sisa Saldo Cuti</div>
                    <div class="saldo-number" id="saldo-cuti">12</div>
                    <div class="saldo-subtitle">hari tersisa tahun ini</div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="stat-card">
                            <div class="stat-label">Terpakai</div>
                            <div class="stat-number" id="cuti-terpakai">8</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="stat-card">
                            <div class="stat-label">Pending</div>
                            <div class="stat-number" id="cuti-pending">2</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="stat-card">
                            <div class="stat-label">Approved</div>
                            <div class="stat-number" id="cuti-approved">6</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="stat-card">
                            <div class="stat-label">Total</div>
                            <div class="stat-number" id="cuti-total">20</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form id="filterForm">
                            <select id="bulan" name="bulan" class="form-select" onchange="filterData()">
                                <option value="">Semua Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Cuti Card -->
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Riwayat Pengajuan Cuti</h3>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <tbody id="cuti-table">
                        <tr>
                            <td colspan="3" class="loading">Memuat data riwayat cuti...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <button class="floating-button" onclick="ajukanCuti()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
            style="display: inline-block; margin-right: 8px; vertical-align: middle;">
            <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
        Ajukan Cuti Baru
    </button>

    <script>
        // Sample data untuk demo
        const sampleCutiData = [{
            id: 1,
            tanggal_mulai: '2024-05-15',
            tanggal_selesai: '2024-05-17',
            jenis_cuti: 'Cuti Tahunan',
            status: 'approved',
            durasi: 3,
            keterangan: 'Liburan keluarga'
        },
        {
            id: 2,
            tanggal_mulai: '2024-05-10',
            tanggal_selesai: '2024-05-10',
            jenis_cuti: 'Cuti Sakit',
            status: 'pending',
            durasi: 1,
            keterangan: 'Demam tinggi'
        },
        {
            id: 3,
            tanggal_mulai: '2024-04-20',
            tanggal_selesai: '2024-04-22',
            jenis_cuti: 'Cuti Tahunan',
            status: 'approved',
            durasi: 3,
            keterangan: 'Acara keluarga'
        },
        {
            id: 4,
            tanggal_mulai: '2024-04-05',
            tanggal_selesai: '2024-04-05',
            jenis_cuti: 'Cuti Pribadi',
            status: 'rejected',
            durasi: 1,
            keterangan: 'Keperluan pribadi'
        }
        ];

        // Load data saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            loadInitialData();
        });

        function loadInitialData() {
            // Update stats
            updateStats({
                saldo: 12,
                terpakai: 8,
                pending: 2,
                approved: 6,
                total: 20
            });

            // Load all data initially
            updateTable(sampleCutiData);
        }

        function filterData() {
            const bulan = document.getElementById('bulan').value;

            // Show loading
            document.getElementById('cuti-table').innerHTML =
                '<tr><td colspan="3" class="loading">Memuat data...</td></tr>';

            // Simulate API delay
            setTimeout(() => {
                let filteredData = sampleCutiData;

                if (bulan) {
                    filteredData = sampleCutiData.filter(item => {
                        const itemMonth = new Date(item.tanggal_mulai).getMonth() + 1;
                        return itemMonth == bulan;
                    });
                }

                updateTable(filteredData);
            }, 500);
        }

        function updateTable(data) {
            const tbody = document.getElementById('cuti-table');

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="3" class="empty-state">
                            <div class="empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div>Belum ada pengajuan cuti</div>
                        </td>
                    </tr>
                `;
                return;
            }

            let html = '';
            data.forEach(item => {
                const tanggalMulai = new Date(item.tanggal_mulai).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short'
                });

                const tanggalSelesai = new Date(item.tanggal_selesai).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short'
                });

                const statusClass = `status-${item.status}`;
                const statusText = {
                    'approved': 'Disetujui',
                    'pending': 'Menunggu',
                    'rejected': 'Ditolak'
                }[item.status];

                const periode = item.tanggal_mulai === item.tanggal_selesai ?
                    tanggalMulai :
                    `${tanggalMulai} - ${tanggalSelesai}`;

                html += `
                    <tr onclick="detailCuti(${item.id})" style="cursor: pointer;">
                        <td>
                            <div class="date-cell">${periode}</div>
                            <div class="type-cell">${item.jenis_cuti} • ${item.durasi} hari</div>
                        </td>
                        <td style="text-align: right;">
                            <span class="status-badge ${statusClass}">${statusText}</span>
                        </td>
                    </tr>
                `;
            });

            tbody.innerHTML = html;
        }

        function updateStats(stats) {
            document.getElementById('saldo-cuti').textContent = stats.saldo || 0;
            document.getElementById('cuti-terpakai').textContent = stats.terpakai || 0;
            document.getElementById('cuti-pending').textContent = stats.pending || 0;
            document.getElementById('cuti-approved').textContent = stats.approved || 0;
            document.getElementById('cuti-total').textContent = stats.total || 0;
        }

        function ajukanCuti() {
            // Redirect ke halaman form pengajuan cuti

            window.location.href = '{{ route('absen.formCuti') }}';
        }

        function detailCuti(id) {
            // Redirect ke halaman detail cuti
            alert(`Lihat detail cuti ID: ${id}`);
            // window.location.href = `/cuti/${id}`;
        }
    </script>
</body>

</html>