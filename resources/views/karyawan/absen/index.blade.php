<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
</head>

<body>
    <div class="container">


        <!-- Header -->
        <div class="header">
            <div class="back-button">
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

        <!-- Map Area -->
        <div class="map-container">
            <div class="map"></div>
            <div class="location-marker"></div>
            <div class="location-dot"></div>
        </div>

        <!-- Info Panel -->
        <div class="info-panel">
            <div class="location-info">
                <div class="section-title">Lokasi</div>
                <div class="location-status">
                    <div>Anda berada di dalam radius kantor</div>
                    <div class="accuracy">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke="#666" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="12" cy="10" r="3" stroke="#666" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Akurasi <span>5 Meter</span>
                    </div>
                </div>
            </div>

            <div class="date-info">
                <div class="date">
                    <div class="calendar-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="4" width="18" height="18" rx="2" stroke="#93331B" stroke-width="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" stroke="#93331B" stroke-width="2" />
                        </svg>
                    </div>
                    Selasa, 13 Mei 2024
                </div>
                <div class="work-hours">
                    Reguler 08.00 - 17.00
                </div>
            </div>

            <div class="action-buttons">
                <div class="check-in">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 11l3 3L22 4M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"
                            stroke="#233b81" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Masuk <span class="check-in-time">09:41</span>
                </div>
                <div class="check-out">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1"
                            stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Pulang -
                </div>
            </div>

            <div class="action-buttons" style="margin-top: 15px;">
                <div class="button-in">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3" stroke="#ccc"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Absen Masuk
                </div>
                <div class="button-out">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3" stroke="white"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Absen Keluar
                </div>
            </div>
        </div>


    </div>
</body>

</html>