<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Absensi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4a5568;
            --secondary-color: #2d3748;
            --accent-color: #3182ce;
            --success-color: #38a169;
            --bg-light: #f7fafc;
            --text-primary: #2d3748;
            --text-secondary: #718096;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-primary);
            padding-bottom: 80px;
            /* Add space for bottom nav */
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .back-button {
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .back-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .back-button svg {
            stroke: white;
        }

        .title {
            font-weight: 600;
            font-size: 18px;
            flex: 1;
            text-align: center;
            margin: 0 15px;
        }

        .header-icons {
            display: flex;
            gap: 10px;
        }

        .notification-icon,
        .menu-icon {
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-icon:hover,
        .menu-icon:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .notification-icon svg,
        .menu-icon svg {
            stroke: white;
        }

        .page-body {
            padding: 20px;
            max-width: 480px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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
            color: var(--secondary-color);
        }

        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            background: white;
            color: var(--text-primary);
            transition: border-color 0.3s, box-shadow 0.3s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-item {
            background: var(--bg-light);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid var(--border-color);
        }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table-header {
            background: var(--bg-light);
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            font-size: 14px;
            color: var(--text-secondary);
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 15px;
        }

        .table-row {
            padding: 15px 20px;
            border-bottom: 1px solid #f8f9fa;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 15px;
            align-items: center;
            transition: background-color 0.3s;
        }

        .table-row:hover {
            background-color: #f8f9fa;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .date-cell {
            color: var(--text-primary);
            font-weight: 500;
            text-decoration: none;
        }

        .time-cell {
            color: var(--text-secondary);
            font-size: 14px;
            text-align: center;
        }

        .loading {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-secondary);
            font-style: italic;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid var(--border-color);
            border-radius: 50%;
            border-top-color: var(--accent-color);
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
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

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 8px 12px;
            text-decoration: none;
            color: var(--text-secondary);
            transition: all 0.3s ease;
            border-radius: 12px;
            cursor: pointer;
            min-width: 60px;
        }

        .nav-item:hover {
            color: var(--accent-color);
            background-color: rgba(49, 130, 206, 0.1);
        }

        .nav-item.active {
            color: var(--accent-color);
            background-color: rgba(49, 130, 206, 0.1);
        }

        .nav-item i {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .nav-item span {
            font-size: 11px;
            font-weight: 600;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 12px 15px;
            }

            .page-body {
                padding: 15px;
            }

            .card-body {
                padding: 15px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .stat-item {
                padding: 12px;
            }

            .stat-number {
                font-size: 20px;
            }

            .table-header,
            .table-row {
                padding: 12px 15px;
                font-size: 13px;
            }

            .nav-item {
                padding: 6px 8px;
                min-width: 50px;
            }

            .nav-item i {
                font-size: 18px;
            }

            .nav-item span {
                font-size: 10px;
            }
        }

        @media (max-width: 480px) {
            .title {
                font-size: 16px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table-header,
            .table-row {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .table-header {
                display: none;
            }

            .table-row {
                background: white;
                border: 1px solid var(--border-color);
                border-radius: 8px;
                margin-bottom: 8px;
                padding: 15px;
            }

            .date-cell {
                font-weight: 600;
                margin-bottom: 8px;
            }

            .time-cell {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 4px;
            }

            .time-cell::before {
                content: attr(data-label);
                font-size: 12px;
                color: var(--text-secondary);
                font-weight: 500;
            }

            .bottom-nav {
                padding: 6px 0;
            }

            .nav-item {
                padding: 4px 6px;
                min-width: 45px;
            }

            .nav-item i {
                font-size: 16px;
                margin-bottom: 2px;
            }

            .nav-item span {
                font-size: 9px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="back-button" onclick="history.back()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </div>
        <div class="title">History Absensi</div>
        <div class="header-icons">
            <div class="notification-icon">
                <i class="fas fa-bell"></i>
            </div>
            <div class="menu-icon">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="card">
            <div class="card-body">
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

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">📊 Statistik Kehadiran</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-label">Absent</div>
                        <div class="stat-number" id="absent-count">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Late Clock In</div>
                        <div class="stat-number" id="late-count">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">No Clock In</div>
                        <div class="stat-number" id="no-clockin-count">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">No Clock Out</div>
                        <div class="stat-number" id="no-clockout-count">0</div>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <div>Tanggal</div>
                    <div>Masuk</div>
                    <div>Keluar</div>
                </div>
                <div id="attendance-table">
                    <div class="loading">
                        <i class="fas fa-calendar-alt"></i>
                        <br><br>
                        Pilih bulan untuk melihat data absensi
                    </div>
                </div>
            </div>
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

    <script>
        // Set bulan saat ini sebagai default
        document.addEventListener('DOMContentLoaded', function() {
            const currentMonth = new Date().getMonth() + 1;
            const bulanSelect = document.getElementById('bulan');
            bulanSelect.value = currentMonth;
            filterData(); // Load data untuk bulan saat ini
        });

        function filterData() {
            const bulan = document.getElementById('bulan').value;
            const tahun = new Date().getFullYear();
            const bulanNama = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            if (!bulan) {
                updateTable([]);
                updateStats({
                    absent: 0,
                    late_clockin: 0,
                    no_clockin: 0,
                    no_clockout: 0
                });
                return;
            }

            // Show loading
            document.getElementById('attendance-table').innerHTML = `
                <div class="loading">
                    <div class="loading-spinner"></div>
                    Memuat data ${bulanNama[bulan]} ${tahun}...
                </div>
            `;

            // Simulate API call with sample data
            setTimeout(() => {
                const sampleData = generateSampleData(bulan, tahun);
                updateTable(sampleData.data);
                updateStats(sampleData.stats);
            }, 1000);
        }

        function generateSampleData(bulan, tahun) {
            const daysInMonth = new Date(tahun, bulan, 0).getDate();
            const data = [];
            let stats = {
                absent: 0,
                late_clockin: 0,
                no_clockin: 0,
                no_clockout: 0
            };

            for (let i = 1; i <= daysInMonth; i++) {
                const date = new Date(tahun, bulan - 1, i);
                const dayOfWeek = date.getDay();

                // Skip weekends
                if (dayOfWeek === 0 || dayOfWeek === 6) continue;

                const random = Math.random();
                let jamMasuk = null;
                let jamKeluar = null;

                if (random > 0.1) { // 90% hadir
                    const masukHour = 8 + Math.floor(Math.random() * 2); // 8-9 AM
                    const masukMinute = Math.floor(Math.random() * 60);
                    jamMasuk = `${masukHour.toString().padStart(2, '0')}:${masukMinute.toString().padStart(2, '0')}`;

                    if (masukHour > 8 || (masukHour === 8 && masukMinute > 0)) {
                        stats.late_clockin++;
                    }

                    if (Math.random() > 0.05) { // 95% yang masuk juga keluar
                        const keluarHour = 17 + Math.floor(Math.random() * 3); // 5-7 PM
                        const keluarMinute = Math.floor(Math.random() * 60);
                        jamKeluar = `${keluarHour.toString().padStart(2, '0')}:${keluarMinute.toString().padStart(2, '0')}`;
                    } else {
                        stats.no_clockout++;
                    }
                } else {
                    stats.absent++;
                    if (Math.random() > 0.5) {
                        stats.no_clockin++;
                    }
                }

                data.push({
                    tanggal: `${tahun}-${bulan.toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`,
                    jam_masuk: jamMasuk,
                    jam_keluar: jamKeluar
                });
            }

            return {
                data,
                stats
            };
        }

        function updateTable(data) {
            const container = document.getElementById('attendance-table');

            if (data.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <br>
                        Tidak ada data absensi
                    </div>
                `;
                return;
            }

            let html = '';
            data.forEach(item => {
                const tanggal = new Date(item.tanggal).toLocaleDateString('id-ID', {
                    weekday: 'short',
                    day: 'numeric',
                    month: 'long'
                });

                html += `
                    <div class="table-row">
                        <div class="date-cell">${tanggal}</div>
                        <div class="time-cell" data-label="Masuk">
                            ${item.jam_masuk || '-'}
                        </div>
                        <div class="time-cell" data-label="Keluar">
                            ${item.jam_keluar || '-'}
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        function updateStats(stats) {
            document.getElementById('absent-count').textContent = stats.absent || 0;
            document.getElementById('late-count').textContent = stats.late_clockin || 0;
            document.getElementById('no-clockin-count').textContent = stats.no_clockin || 0;
            document.getElementById('no-clockout-count').textContent = stats.no_clockout || 0;
        }

        // Bottom Navigation Functions
        function navigateTo(page) {
            // Remove active class from all nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });

            // Add active class to clicked item
            event.target.closest('.nav-item').classList.add('active');

            // Add navigation logic here
            switch (page) {
                case 'home':
                    console.log('Navigate to Home');
                    // window.location.href = '/home';
                    break;
                case 'history':
                    console.log('Already on History page');
                    break;
                case 'profile':
                    console.log('Navigate to Profile');
                    // window.location.href = '/profile';
                    break;
                case 'settings':
                    console.log('Navigate to Settings');
                    // window.location.href = '/settings';
                    break;
            }
        }

        // Add click effects
        document.querySelectorAll('.notification-icon, .menu-icon, .back-button').forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Add click effects to nav items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    </script>
</body>

</html>
