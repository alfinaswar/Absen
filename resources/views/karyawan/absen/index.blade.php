<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi dengan Map</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Reset dan Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Container untuk membatasi maksimal lebar pada desktop */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        /* Header Styles - Mobile First */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 10;
            width: 100%;
        }

        .back-button,
        .notification-icon,
        .menu-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            cursor: pointer;
            border-radius: 50%;
            transition: background-color 0.2s ease;
            flex-shrink: 0;
        }

        .back-button:hover,
        .notification-icon:hover,
        .menu-icon:hover {
            background-color: #f5f5f5;
        }

        .title {
            flex: 1;
            text-align: center;
            font-weight: 600;
            font-size: 16px;
            margin: 0 12px;
        }

        .header-icons {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        /* Map Container - Mobile First */
        .map-container {
            position: relative;
            height: 40vh;
            min-height: 250px;
            background-color: #ddd;
            width: 100%;
        }

        #map {
            height: 100%;
            width: 100%;
            z-index: 1;
        }

        /* Info Panel - Mobile First */
        .info-panel {
            background-color: #fff;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            margin-top: -20px;
            padding: 16px;
            position: relative;
            z-index: 2;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.05);
            min-height: 60vh;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: #444;
            font-size: 14px;
        }

        .location-status {
            background-color: #e8f5e9;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 13px;
            word-wrap: break-word;
        }

        .location-status.outside {
            background-color: #ffebee;
        }

        .accuracy {
            display: flex;
            align-items: center;
            margin-top: 8px;
            color: #666;
            font-size: 11px;
            gap: 4px;
            flex-wrap: wrap;
        }

        .accuracy span {
            font-weight: 500;
        }

        .date-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .date {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #333;
            font-weight: 500;
        }

        .work-hours {
            color: #666;
            font-size: 12px;
        }

        /* Action Buttons - Mobile First */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 12px;
        }

        .check-in,
        .check-out {
            padding: 12px;
            border-radius: 8px;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #666;
            min-height: 44px;
        }

        .check-in {
            color: #233b81;
            background-color: #e8f0fe;
        }

        .check-in-time {
            font-weight: 600;
            margin-left: auto;
        }

        .button-in,
        .button-out {
            padding: 14px 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
            min-height: 48px;
            border: none;
            width: 100%;
            margin-bottom: 8px;
        }

        .button-in {
            background-color: #e8f0fe;
            color: #233b81;
            border: 1px solid #d0e1fd;
        }

        .button-in.disabled {
            background-color: #f5f5f5;
            color: #ccc;
            border: 1px solid #eee;
            cursor: not-allowed;
        }

        .button-out {
            background-color: #e91e1e;
            color: white;
        }

        .button-out.disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Modal Styles - Mobile First */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            z-index: 100;
            align-items: center;
            justify-content: center;
            padding: 12px;
            overflow-y: auto;
        }

        .modal-content {
            width: 100%;
            max-width: 500px;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            max-height: 95vh;
            display: flex;
            flex-direction: column;
            margin: auto;
        }

        .modal-header {
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            background: #fff;
            flex-shrink: 0;
        }

        .modal-title {
            font-weight: 600;
            font-size: 16px;
        }

        .close-modal {
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        .close-modal:hover {
            background-color: #f5f5f5;
        }

        .modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
        }

        /* Form Styles - Mobile First */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            background-color: #fff;
            transition: border-color 0.2s ease;
            min-height: 44px;
        }

        .form-select:focus {
            outline: none;
            border-color: #233b81;
        }

        /* Camera Styles - Mobile First */
        .camera-section {
            margin-bottom: 16px;
        }

        #cameraFeed {
            width: 100%;
            height: 30vh;
            min-height: 200px;
            background: #000;
            object-fit: cover;
            border-radius: 8px;
        }

        #previewCanvas {
            width: 100%;
            height: 30vh;
            min-height: 200px;
            background: #000;
            object-fit: cover;
            border-radius: 8px;
            display: none;
        }

        .camera-controls {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 12px;
        }

        .btn {
            padding: 12px 16px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: #233b81;
            color: white;
        }

        .btn-primary:hover {
            background: #1a2c61;
        }

        .btn-secondary {
            background: #f5f5f5;
            color: #333;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
        }

        .btn-success {
            background: #4caf50;
            color: white;
        }

        .btn-success:hover {
            background: #45a049;
        }

        .btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .modal-footer {
            padding: 16px;
            border-top: 1px solid #eee;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-shrink: 0;
        }

        .loading-indicator {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            display: none;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #233b81;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .attendance-success {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #4caf50;
            color: white;
            padding: 12px 16px;
            border-radius: 8px;
            display: none;
            z-index: 1001;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: calc(100% - 40px);
            max-width: 300px;
            text-align: center;
            font-size: 14px;
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: none;
            font-size: 13px;
            word-wrap: break-word;
        }

        /* Tablet Styles (768px and up) */
        @media (min-width: 768px) {
            .header {
                padding: 12px 24px;
            }

            .title {
                font-size: 18px;
            }

            .map-container {
                height: 45vh;
                min-height: 300px;
            }

            .info-panel {
                padding: 24px;
                border-radius: 0;
                margin-top: 0;
                min-height: auto;
            }

            .date-info {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            .action-buttons {
                flex-direction: row;
                gap: 12px;
            }

            .camera-controls {
                flex-direction: row;
                justify-content: center;
            }

            .modal-footer {
                flex-direction: row;
                justify-content: flex-end;
            }

            #cameraFeed,
            #previewCanvas {
                height: 40vh;
                min-height: 300px;
            }

            .btn {
                min-width: 120px;
            }

            .attendance-success {
                width: auto;
                min-width: 300px;
            }
        }

        /* Desktop Styles (1024px and up) */
        @media (min-width: 1024px) {
            body {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            }

            .container {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                max-width: 800px;
                margin: 0 auto;
                background: #fff;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .header {
                border-radius: 0;
            }

            .map-container {
                height: 50vh;
                min-height: 400px;
            }

            .info-panel {
                padding: 32px;
                flex: 1;
            }

            .section-title {
                font-size: 16px;
            }

            .location-status {
                font-size: 14px;
                padding: 16px;
            }

            .accuracy {
                font-size: 12px;
            }

            .date-info {
                font-size: 14px;
            }

            .modal {
                padding: 24px;
            }

            .modal-content {
                max-width: 600px;
            }

            .modal-body {
                padding: 24px;
            }

            .modal-footer {
                padding: 24px;
            }

            #cameraFeed,
            #previewCanvas {
                height: 45vh;
                min-height: 350px;
            }

            .spinner {
                width: 60px;
                height: 60px;
                border-width: 6px;
            }
        }

        /* Large Desktop Styles (1440px and up) */
        @media (min-width: 1440px) {
            .container {
                max-width: 1000px;
            }

            .info-panel {
                padding: 40px;
            }

            .map-container {
                height: 55vh;
                min-height: 500px;
            }

            .section-title {
                font-size: 18px;
            }

            .location-status {
                font-size: 15px;
                padding: 18px;
            }

            .date-info {
                font-size: 15px;
            }

            .button-in,
            .button-out {
                font-size: 15px;
                padding: 16px 12px;
                min-height: 52px;
            }
        }

        /* Landscape Orientation for Mobile */
        @media (max-width: 767px) and (orientation: landscape) {
            .map-container {
                height: 25vh;
                min-height: 150px;
            }

            #cameraFeed,
            #previewCanvas {
                height: 25vh;
                min-height: 150px;
            }

            .modal-content {
                max-height: 90vh;
            }
        }

        /* High DPI Displays */
        @media (-webkit-min-device-pixel-ratio: 2),
        (min-resolution: 192dpi),
        (min-resolution: 2dppx) {
            .spinner {
                border-width: 3px;
            }

            .header {
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            }
        }

        /* Accessibility - Reduce Motion */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            .spinner {
                animation: none;
                border: 4px solid #233b81;
            }
        }

        /* Dark Mode Support */
        /* @media (prefers-color-scheme: dark) {
            body {
                background-color: #121212;
                color: #ffffff;
            }

            .header {
                background-color: #1e1e1e;
                box-shadow: 0 2px 4px rgba(255, 255, 255, 0.1);
            }

            .info-panel {
                background-color: #1e1e1e;
                box-shadow: 0 -4px 10px rgba(255, 255, 255, 0.05);
            }

            .location-status {
                background-color: #2d4a2d;
                color: #e8f5e9;
            }

            .location-status.outside {
                background-color: #4a2d2d;
                color: #ffebee;
            }

            .modal-content {
                background: #1e1e1e;
            }

            .form-select {
                background-color: #2d2d2d;
                border-color: #444;
                color: #ffffff;
            }

            .btn-secondary {
                background: #2d2d2d;
                color: #ffffff;
            }
        } */
    </style>
</head>

<body>
    <div class="header">
        <a href="{{route('home')}}" class="back-button">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="#000" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
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
        <div id="map"></div>
    </div>

    <!-- Info Panel -->
    <div class="info-panel">
        <div class="location-info">
            <div class="section-title">Lokasi</div>
            <div class="location-status" id="locationStatus">
                <div id="locationText">Mendapatkan lokasi saat ini...</div>
                <div class="accuracy">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke="#666" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="12" cy="10" r="3" stroke="#666" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Akurasi <span id="accuracyText">-</span>
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
                <span id="currentDate">Loading...</span>
            </div>
            <div class="work-hours">
                {{ $user->getShift->nama_shift ?? '-' }},
                {{ isset($user->getShift->jam_masuk) ? \Carbon\Carbon::parse($user->getShift->jam_masuk)->format('H:i') : '-' }}
                -
                {{ isset($user->getShift->jam_keluar) ? \Carbon\Carbon::parse($user->getShift->jam_keluar)->format('H:i') : '-' }}
            </div>
        </div>
        @php
            use Carbon\Carbon;

            Carbon::setLocale('id');

            $tanggal = Carbon::today();
            $masuk = $user->getAbsensi->where('jenis_absen', 'Masuk')->first();
            $pulang = $user->getAbsensi->where('jenis_absen', 'Pulang')->first();
        @endphp
        <div class="action-buttons">
            <div class="check-in">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 11l3 3L22 4M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" stroke="#233b81"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Masuk <span class="check-in-time"
                    id="checkInTime">{{ isset($masuk->waktu_absen) ? \Carbon\Carbon::parse($masuk->waktu_absen)->format('H:i') : '-' }}</span>
            </div>
            <div class="check-out">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1"
                        stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Pulang <span
                    id="checkOutTime">{{ isset($pulang->waktu_absen) ? \Carbon\Carbon::parse($pulang->waktu_absen)->format('H:i') : '-' }}</span>
            </div>
        </div>

        <div class="action-buttons" style="margin-top: 15px;">

            <div class="button-in" id="checkInButton">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Absen Masuk
            </div>
            <div class="button-out" id="checkOutButton">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3" stroke="white"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Absen Keluar
            </div>
        </div>
    </div>

    <!-- Attendance Modal -->
    <div class="modal" id="attendanceModal" style="overflow-y: auto; max-height: 90vh;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="modalTitle">Absen Masuk</div>
                <div class="close-modal" id="closeModal">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6l12 12" stroke="#000" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>

            <form id="attendanceForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="error-message" id="errorMessage"></div>

                    <!-- Shift Selection (only for check-in) -->
                    <div class="form-group" id="shiftGroup">
                        <label class="form-label" for="shift">Pilih Shift</label>
                        <select class="form-select" id="shift" name="shift_id" required>
                            <option value="">-- Pilih Shift --</option>
                            @foreach ($shift as $item)
                                <option value="{{ $item->id }}" @if ($user->getShift->id == $item->id) selected @endif>
                                    {{ $item->nama_shift }}, {{ $item->jam_masuk }} -
                                    {{ $item->jam_keluar }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Camera Section -->
                    <div class="camera-section">
                        <label class="form-label">Ambil Foto Selfie</label>
                        <video id="cameraFeed" autoplay muted></video>
                        <canvas id="previewCanvas"></canvas>

                        <div class="camera-controls">
                            <button type="button" class="btn btn-primary" id="captureButton">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"
                                        stroke="currentColor" stroke-width="2" />
                                    <circle cx="12" cy="13" r="4" stroke="currentColor" stroke-width="2" />
                                </svg>
                                Ambil Foto
                            </button>
                            <button type="button" class="btn btn-secondary" id="retakeButton" style="display: none;">
                                Ambil Ulang
                            </button>
                        </div>
                    </div>

                    <!-- Hidden inputs -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="accuracy" id="accuracy">
                    <input type="hidden" name="type" id="attendanceType">
                    <input type="hidden" name="photo" id="photoData">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelButton">Batal</button>
                    <button type="submit" class="btn btn-success" id="submitButton" disabled>
                        <span id="submitText">Kirim Absensi</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div class="loading-indicator" id="loadingIndicator">
        <div class="spinner"></div>
    </div>

    <!-- Success Notification -->
    <div class="attendance-success" id="attendanceSuccess">
        Absensi berhasil dicatat!
    </div>

    <!-- Leaflet JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <script>
        // Configuration - Replace with your actual values
        const officeLocation = {
            lat: {{ $user->getPerusahaan->Latitude ?? '-6.2088' }}, // Latitude kota Pekanbaru
            lng: {{ $user->getPerusahaan->Longitude ?? '106.8456' }} // Longitude kota Pekanbaru
        };
        const officeRadius = 1002; // in meters - adjust as needed

        // DOM elements
        const locationStatus = document.getElementById('locationStatus');
        const locationText = document.getElementById('locationText');
        const accuracyText = document.getElementById('accuracyText');
        const checkInButton = document.getElementById('checkInButton');
        const checkOutButton = document.getElementById('checkOutButton');
        const checkInTime = document.getElementById('checkInTime');
        const checkOutTime = document.getElementById('checkOutTime');
        const currentDateElement = document.getElementById('currentDate');

        // Modal elements
        const attendanceModal = document.getElementById('attendanceModal');
        const modalTitle = document.getElementById('modalTitle');
        const closeModal = document.getElementById('closeModal');
        const attendanceForm = document.getElementById('attendanceForm');
        const shiftGroup = document.getElementById('shiftGroup');
        const errorMessage = document.getElementById('errorMessage');

        // Camera elements
        const cameraFeed = document.getElementById('cameraFeed');
        const previewCanvas = document.getElementById('previewCanvas');
        const captureButton = document.getElementById('captureButton');
        const retakeButton = document.getElementById('retakeButton');
        const cancelButton = document.getElementById('cancelButton');
        const submitButton = document.getElementById('submitButton');
        const submitText = document.getElementById('submitText');

        // Form inputs
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const accuracyInput = document.getElementById('accuracy');
        const attendanceTypeInput = document.getElementById('attendanceType');
        const photoDataInput = document.getElementById('photoData');
        const shiftSelect = document.getElementById('shift');

        // Other elements
        const loadingIndicator = document.getElementById('loadingIndicator');
        const attendanceSuccess = document.getElementById('attendanceSuccess');

        // Initialize variables
        let map;
        let userMarker;
        let officeMarker;
        let radiusCircle;
        let isWithinRadius = false;
        let userLocation = null;
        let locationAccuracy = 0;
        let mediaStream = null;
        let hasCheckedIn = false;
        let hasCheckedOut = false;
        let capturedPhotoData = null;

        // Set current date
        function setCurrentDate() {
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const now = new Date();
            const day = days[now.getDay()];
            const date = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            currentDateElement.textContent = `${day}, ${date} ${month} ${year}`;
        }

        // Initialize map
        function initMap() {
            map = L.map('map').setView([officeLocation.lat, officeLocation.lng], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add office marker
            const officeIcon = L.icon({
                iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-icon.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                shadowSize: [41, 41]
            });

            officeMarker = L.marker([officeLocation.lat, officeLocation.lng], {
                icon: officeIcon
            }).addTo(map);
            officeMarker.bindPopup("Lokasi Kantor").openPopup();

            // Add office radius
            radiusCircle = L.circle([officeLocation.lat, officeLocation.lng], {
                color: '#233b81',
                fillColor: '#4d69b5',
                fillOpacity: 0.2,
                radius: officeRadius
            }).addTo(map);
        }

        // Get user location
        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(
                    (position) => {
                        userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        locationAccuracy = Math.round(position.coords.accuracy);

                        updateMap();
                        checkDistance();
                    },
                    (error) => {
                        console.error("Error getting location:", error);
                        locationText.textContent = "Tidak dapat mengakses lokasi Anda";
                        locationStatus.classList.add("outside");
                        accuracyText.textContent = "-";
                        showError("Tidak dapat mengakses lokasi Anda. Pastikan GPS aktif dan izin lokasi diberikan.");
                    }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
                );
            } else {
                locationText.textContent = "Browser Anda tidak mendukung geolokasi";
                locationStatus.classList.add("outside");
                showError("Browser Anda tidak mendukung geolokasi");
            }
        }

        // Update map with user location
        function updateMap() {
            if (!userLocation) return;

            // Update or create user marker
            if (userMarker) {
                userMarker.setLatLng([userLocation.lat, userLocation.lng]);
            } else {
                const userIcon = L.divIcon({
                    className: 'user-marker',
                    html: `<div style="background-color: #1E88E5; width: 16px; height: 16px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px #1E88E5;"></div>`,
                    iconSize: [24, 24],
                    iconAnchor: [12, 12]
                });

                userMarker = L.marker([userLocation.lat, userLocation.lng], {
                    icon: userIcon,
                    zIndexOffset: 1000
                }).addTo(map);
            }

            // Fit map bounds to show both office and user
            const bounds = L.latLngBounds([
                [officeLocation.lat, officeLocation.lng],
                [userLocation.lat, userLocation.lng]
            ]);
            map.fitBounds(bounds, {
                padding: [50, 50]
            });

            // Update accuracy text
            accuracyText.textContent = `${locationAccuracy} Meter`;
        }

        // Check if user is within office radius
        function checkDistance() {
            if (!userLocation) return;

            // Calculate distance between office and user (using Haversine formula)
            const R = 6371e3; // Earth's radius in meters
            const φ1 = officeLocation.lat * Math.PI / 180;
            const φ2 = userLocation.lat * Math.PI / 180;
            const Δφ = (userLocation.lat - officeLocation.lat) * Math.PI / 180;
            const Δλ = (userLocation.lng - officeLocation.lng) * Math.PI / 180;

            const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            const distance = R * c;

            isWithinRadius = distance <= officeRadius;

            // Update UI
            if (isWithinRadius) {
                locationText.textContent = "Anda berada di dalam radius kantor";
                locationStatus.classList.remove("outside");
                enableAttendanceButtons();
            } else {
                locationText.textContent = `Anda berada di luar radius kantor (${Math.round(distance)}m dari kantor)`;
                locationStatus.classList.add("outside");
                disableAttendanceButtons();
            }
        }

        // Enable/disable attendance buttons
        function enableAttendanceButtons() {
            if (!hasCheckedIn) {
                checkInButton.classList.remove("disabled");
            }
            if (hasCheckedIn && !hasCheckedOut) {
                checkOutButton.classList.remove("disabled");
            }
        }

        function disableAttendanceButtons() {
            checkInButton.classList.add("disabled");
            checkOutButton.classList.add("disabled");
        }

        // Show error message
        function showError(message) {
            errorMessage.textContent = message;
            errorMessage.style.display = 'block';
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 5000);
        }

        // Show success message
        function showSuccess(message) {
            attendanceSuccess.textContent = message;
            attendanceSuccess.style.display = 'block';
            setTimeout(() => {
                attendanceSuccess.style.display = 'none';
            }, 3000);
        }

        // Modal functions
        function openAttendanceModal(type) {
            if (!isWithinRadius) {
                showError("Anda harus berada di dalam radius kantor untuk melakukan absensi.");
                return;
            }

            if (!userLocation) {
                showError("Lokasi belum terdeteksi. Tunggu sebentar dan coba lagi.");
                return;
            }

            attendanceTypeInput.value = type;

            if (type === 'Masuk') {
                modalTitle.textContent = 'Absen Masuk';
                shiftGroup.style.display = 'block';
                submitText.textContent = 'Absen Masuk';
            } else {
                modalTitle.textContent = 'Absen Keluar';
                shiftGroup.style.display = 'block';
                submitText.textContent = 'Absen Keluar';
            }

            // Set location data
            latitudeInput.value = userLocation.lat;
            longitudeInput.value = userLocation.lng;
            accuracyInput.value = locationAccuracy;

            // Reset form
            resetCameraState();
            capturedPhotoData = null;
            submitButton.disabled = true;

            attendanceModal.style.display = 'flex';
            startCamera();
        }

        function closeAttendanceModal() {
            attendanceModal.style.display = 'none';
            stopCamera();
            resetForm();
        }

        function resetForm() {
            attendanceForm.reset();
            capturedPhotoData = null;
            resetCameraState();
            errorMessage.style.display = 'none';
        }

        // Camera functions
        function startCamera() {
            navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: "user",
                    width: {
                        ideal: 640
                    },
                    height: {
                        ideal: 480
                    }
                },
                audio: false
            })
                .then((stream) => {
                    mediaStream = stream;
                    cameraFeed.srcObject = stream;
                    cameraFeed.play();
                })
                .catch((error) => {
                    console.error("Error accessing camera:", error);
                    showError("Tidak dapat mengakses kamera. Pastikan izin kamera diberikan.");
                });
        }

        function stopCamera() {
            if (mediaStream) {
                mediaStream.getTracks().forEach(track => track.stop());
                mediaStream = null;
            }
        }

        function resetCameraState() {
            cameraFeed.style.display = 'block';
            previewCanvas.style.display = 'none';
            captureButton.style.display = 'inline-flex';
            retakeButton.style.display = 'none';
        }

        function capturePhoto() {
            if (!mediaStream) {
                showError("Kamera belum siap. Coba lagi dalam beberapa detik.");
                return;
            }

            const canvas = previewCanvas;
            const context = canvas.getContext('2d');

            // Set canvas dimensions to match video
            canvas.width = cameraFeed.videoWidth;
            canvas.height = cameraFeed.videoHeight;

            // Draw video frame to canvas
            context.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);

            // Convert to base64
            capturedPhotoData = canvas.toDataURL('image/jpeg', 0.8);
            photoDataInput.value = capturedPhotoData;

            // Switch to preview mode
            showPreview();

            // Enable submit button if all requirements are met
            checkFormValidity();
        }

        function showPreview() {
            cameraFeed.style.display = 'none';
            previewCanvas.style.display = 'block';
            captureButton.style.display = 'none';
            retakeButton.style.display = 'inline-flex';
        }

        function retakePhoto() {
            resetCameraState();
            capturedPhotoData = null;
            photoDataInput.value = '';
            submitButton.disabled = true;
        }

        function checkFormValidity() {
            const isPhotoTaken = capturedPhotoData !== null;
            const isShiftSelected = attendanceTypeInput.value === 'Keluar' || shiftSelect.value !== '';

            submitButton.disabled = !(isPhotoTaken && isShiftSelected);
        }

        // Form submission
        function handleFormSubmit(event) {
            event.preventDefault();

            if (!capturedPhotoData) {
                showError("Silakan ambil foto terlebih dahulu.");
                return;
            }

            if (attendanceTypeInput.value === 'Masuk' && !shiftSelect.value) {
                showError("Silakan pilih shift terlebih dahulu.");
                return;
            }

            // Show loading
            loadingIndicator.style.display = 'flex';

            // Get location name using reverse geocoding
            getLocationName(latitudeInput.value, longitudeInput.value)
                .then(locationName => {
                    submitFormWithLocation(locationName);
                })
                .catch(error => {
                    console.error('Error getting location name:', error);
                    // Submit without location name if geocoding fails
                    submitFormWithLocation('Lokasi tidak diketahui');
                });
        }

        function getLocationName(lat, lng) {
            return new Promise((resolve, reject) => {
                // Using Nominatim (OpenStreetMap) reverse geocoding service
                const geocodeUrl =
                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`;

                fetch(geocodeUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.display_name) {
                            // Extract useful parts of the address
                            const address = data.address || {};
                            let locationName = '';

                            // Build location name from available components
                            if (address.road) locationName += address.road;
                            if (address.village || address.suburb) {
                                locationName += (locationName ? ', ' : '') + (address.village || address
                                    .suburb);
                            }
                            if (address.city || address.town) {
                                locationName += (locationName ? ', ' : '') + (address.city || address.town);
                            }

                            // Fallback to display_name if no specific components found
                            if (!locationName) {
                                locationName = data.display_name.split(',').slice(0, 3).join(', ');
                            }

                            resolve(locationName);
                        } else {
                            reject('No location data found');
                        }
                    })
                    .catch(error => reject(error));
            });
        }

        function submitFormWithLocation(locationName) {
            // Prepare form data
            const formData = new FormData();
            formData.append('_token', document.querySelector('input[name="_token"]').value);
            formData.append('type', attendanceTypeInput.value);
            formData.append('latitude', latitudeInput.value);
            formData.append('longitude', longitudeInput.value);
            formData.append('accuracy', accuracyInput.value);
            formData.append('location_name', locationName); // Add location name

            if (attendanceTypeInput.value === 'Masuk') {
                formData.append('shift_id', shiftSelect.value);
            } else {
                formData.append('shift_id', shiftSelect.value);
            }

            // Convert base64 image to blob
            const photoBlob = dataURLtoBlob(capturedPhotoData);
            formData.append('photo', photoBlob, 'selfie.jpg');

            // Submit to server using Fetch API
            fetch('{{ route('absen.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    loadingIndicator.style.display = 'none';

                    if (data.success) {
                        closeAttendanceModal();
                        updateAttendanceStatus(attendanceTypeInput.value);
                        showSuccess(data.message || 'Absensi berhasil dicatat!');
                    } else {
                        showError(data.message || 'Terjadi kesalahan saat mencatat absensi.');
                    }
                })
                .catch(error => {
                    loadingIndicator.style.display = 'none';
                    console.error('Error:', error);
                    showError('Terjadi kesalahan saat mengirim data. Periksa koneksi internet Anda.');
                });
        }

        // Helper function to convert base64 to blob
        function dataURLtoBlob(dataurl) {
            const arr = dataurl.split(',');
            const mime = arr[0].match(/:(.*?);/)[1];
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], {
                type: mime
            });
        }

        // Update attendance status after successful submission
        function updateAttendanceStatus(type) {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const timeString = `${hours}:${minutes}`;

            if (type === 'Masuk') {
                checkInTime.textContent = timeString;
                hasCheckedIn = true;
                checkInButton.classList.add("disabled");
                if (isWithinRadius) {
                    checkOutButton.classList.remove("disabled");
                }
            } else {
                checkOutTime.textContent = timeString;
                hasCheckedOut = true;
                checkOutButton.classList.add("disabled");
            }
        }

        // Event listeners
        function setupEventListeners() {
            // Check-in button
            checkInButton.addEventListener('click', () => {
                if (!checkInButton.classList.contains('disabled')) {
                    openAttendanceModal('Masuk');
                }
            });

            // Check-out button
            checkOutButton.addEventListener('click', () => {
                if (!checkOutButton.classList.contains('disabled')) {
                    openAttendanceModal('Keluar');
                }
            });

            // Modal controls
            closeModal.addEventListener('click', closeAttendanceModal);
            cancelButton.addEventListener('click', closeAttendanceModal);

            // Camera controls
            captureButton.addEventListener('click', capturePhoto);
            retakeButton.addEventListener('click', retakePhoto);

            // Form controls
            attendanceForm.addEventListener('submit', handleFormSubmit);
            shiftSelect.addEventListener('change', checkFormValidity);

            // Close modal when clicking outside
            attendanceModal.addEventListener('click', (e) => {
                if (e.target === attendanceModal) {
                    closeAttendanceModal();
                }
            });
        }

        // Initialize application
        function initApp() {
            setCurrentDate();
            initMap();
            getUserLocation();
            setupEventListeners();

            // // Initially disable check-out button
            // checkOutButton.classList.add("disabled");
        }

        // Start the application when page loads
        window.addEventListener("load", initApp);
    </script>
</body>

</html>