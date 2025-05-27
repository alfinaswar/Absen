<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Absensi</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
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
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .col-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding: 10px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 10px;
        }

        .fw-bold {
            font-weight: 600;
            font-size: 12px;
            color: #6b7280;
        }

        .stat-number {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }

        .text-reset {
            color: #1f2937;
            text-decoration: none;
            font-weight: 500;
        }

        .text-secondary {
            color: #6b7280;
            font-size: 14px;
        }

        .text-nowrap {
            white-space: nowrap;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: #6b7280;
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
        <div class="title">Absensi</div>
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
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form id="filterForm">
                            <select id="bulan" name="bulan" class="form-select" onchange="filterData()">
                                <option value="">Pilih Bulan</option>
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

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Attendance Log</h3>
                <div class="row">
                    <div class="col-4">
                        <div>
                            <span class="fw-bold">Absent</span><br>
                            <span class="stat-number" id="absent-count">12</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div>
                            <span class="fw-bold">Late Clockin</span><br>
                            <span class="stat-number" id="late-count">12</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div>
                            <span class="fw-bold">No Clockin</span><br>
                            <span class="stat-number" id="no-clockin-count">12</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div>
                            <span class="fw-bold">No Clock Out</span><br>
                            <span class="stat-number" id="no-clockout-count">12</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <tbody id="attendance-table">
                        <tr>
                            <td colspan="3" class="loading">Pilih bulan untuk melihat data absensi</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Set bulan saat ini sebagai default
        document.addEventListener('DOMContentLoaded', function () {
            const currentMonth = new Date().getMonth() + 1;
            const bulanSelect = document.getElementById('bulan');
            bulanSelect.value = currentMonth;
            filterData(); // Load data untuk bulan saat ini
        });

        function filterData() {
            const bulan = document.getElementById('bulan').value;
            const tahun = new Date().getFullYear();

            if (!bulan) {
                updateTable([]);
                updateStats({ absent: 0, late_clockin: 0, no_clockin: 0, no_clockout: 0 });
                return;
            }

            // Show loading
            document.getElementById('attendance-table').innerHTML = '<tr><td colspan="3" class="loading">Memuat data...</td></tr>';

            // Simulate API call - replace with actual Laravel route
            const url = window.location.pathname + '?bulan=' + bulan + '&tahun=' + tahun;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateTable(data.data);
                        updateStats(data.stats);
                    } else {
                        console.error('Error loading data');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    // Fallback to form submit for non-AJAX environments
                    document.getElementById('filterForm').action = window.location.pathname;
                    document.getElementById('filterForm').method = 'GET';
                    document.getElementById('filterForm').submit();
                });
        }

        function updateTable(data) {
            const tbody = document.getElementById('attendance-table');

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="3" class="text-center">Tidak ada data absen</td></tr>';
                return;
            }

            let html = '';
            data.forEach(item => {
                const tanggal = new Date(item.tanggal).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

                html += `
                    <tr>
                        <td>
                            <a href="#" class="text-reset">${tanggal}</a>
                        </td>
                        <td class="text-nowrap text-secondary">
                            ${item.jam_masuk || '-'}
                        </td>
                        <td class="text-nowrap text-secondary">
                            ${item.jam_keluar || '-'}
                        </td>
                    </tr>
                `;
            });

            tbody.innerHTML = html;
        }

        function updateStats(stats) {
            document.getElementById('absent-count').textContent = stats.absent || 0;
            document.getElementById('late-count').textContent = stats.late_clockin || 0;
            document.getElementById('no-clockin-count').textContent = stats.no_clockin || 0;
            document.getElementById('no-clockout-count').textContent = stats.no_clockout || 0;
        }
    </script>
</body>

</html>