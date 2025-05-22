<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi dengan Map</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />

</head>

<body>
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
                {{$user->getShift->nama_shift}}, {{ \Carbon\Carbon::parse($user->getShift->jam_masuk)->format('H:i') }}
                -
                {{ \Carbon\Carbon::parse($user->getShift->jam_keluar)->format('H:i') }}

            </div>
        </div>

        <div class="action-buttons">
            <div class="check-in">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 11l3 3L22 4M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" stroke="#233b81"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Masuk <span class="check-in-time" id="checkInTime">-</span>
            </div>
            <div class="check-out">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1"
                        stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Pulang <span id="checkOutTime">-</span>
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

    <!-- Camera Modal -->
    <div class="modal" id="cameraModal">
        <div class="camera-container">
            <div class="camera-header">
                <div class="camera-title">Ambil Foto Selfie</div>
                <div class="close-camera" id="closeCamera">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6l12 12" stroke="#000" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <form action="/absen" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="camera-content">
                    <video id="cameraFeed" autoplay></video>
                    <canvas id="capturedImage"></canvas>
                    <input type="file" name="foto" id="foto" accept="image/*" capture="camera" hidden>
                    <div class="camera-controls">
                        <button class="capture-btn" id="captureButton" type="button">Ambil Foto</button>
                    </div>
                    <div class="preview-controls">
                        <button class="retake-btn" id="retakeButton" type="button">Ambil Ulang</button>
                        <button class="confirm-btn" id="confirmButton" type="submit">Konfirmasi</button>
                    </div>
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
        // Configuration
        const officeLocation = {
            lat: {{ $user-> getPerusahaan -> Latitude}},
        lng: { { $user -> getPerusahaan -> Longitude } }
        };
        const officeRadius = 100; // in meters - adjust as needed

        // DOM elements
        const locationStatus = document.getElementById('locationStatus');
        const locationText = document.getElementById('locationText');
        const accuracyText = document.getElementById('accuracyText');
        const checkInButton = document.getElementById('checkInButton');
        const checkOutButton = document.getElementById('checkOutButton');
        const checkInTime = document.getElementById('checkInTime');
        const checkOutTime = document.getElementById('checkOutTime');
        const currentDateElement = document.getElementById('currentDate');
        const cameraModal = document.getElementById('cameraModal');
        const cameraFeed = document.getElementById('cameraFeed');
        const captureButton = document.getElementById('captureButton');
        const closeCamera = document.getElementById('closeCamera');
        const capturedImage = document.getElementById('capturedImage');
        const retakeButton = document.getElementById('retakeButton');
        const confirmButton = document.getElementById('confirmButton');
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
        let isCheckingIn = true;
        let hasCheckedIn = false;
        let hasCheckedOut = false;

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

            officeMarker = L.marker([officeLocation.lat, officeLocation.lng], { icon: officeIcon }).addTo(map);
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
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                locationText.textContent = "Browser Anda tidak mendukung geolokasi";
                locationStatus.classList.add("outside");
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
            map.fitBounds(bounds, { padding: [50, 50] });

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
                enableCheckInButton();
            } else {
                locationText.textContent = "Anda berada di luar radius kantor";
                locationStatus.classList.add("outside");
                disableCheckInButton();
            }
        }

        // Enable/disable check-in button
        function enableCheckInButton() {
            if (!hasCheckedIn) {
                checkInButton.classList.remove("disabled");
                checkInButton.addEventListener("click", openCamera);
            }
        }

        function disableCheckInButton() {
            checkInButton.classList.add("disabled");
            checkInButton.removeEventListener("click", openCamera);
        }

        // Camera functions
        function openCamera() {
            isCheckingIn = true;
            cameraModal.style.display = "flex";

            // Request camera access
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" }, audio: false })
                .then((stream) => {
                    mediaStream = stream;
                    cameraFeed.srcObject = stream;
                    showCameraUI();
                })
                .catch((error) => {
                    console.error("Error accessing camera:", error);
                    alert("Tidak dapat mengakses kamera");
                    closeCamera.click();
                });
        }

        function openCameraForCheckout() {
            isCheckingIn = false;
            cameraModal.style.display = "flex";

            navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" }, audio: false })
                .then((stream) => {
                    mediaStream = stream;
                    cameraFeed.srcObject = stream;
                    showCameraUI();
                })
                .catch((error) => {
                    console.error("Error accessing camera:", error);
                    alert("Tidak dapat mengakses kamera");
                    closeCamera.click();
                });
        }

        function showCameraUI() {
            cameraFeed.style.display = "block";
            capturedImage.style.display = "none";
            document.querySelector(".camera-controls").style.display = "flex";
            document.querySelector(".preview-controls").style.display = "none";
        }

        function showPreviewUI() {
            cameraFeed.style.display = "none";
            capturedImage.style.display = "block";
            document.querySelector(".camera-controls").style.display = "none";
            document.querySelector(".preview-controls").style.display = "flex";
        }

        function capturePhoto() {
            const canvas = capturedImage;
            const context = canvas.getContext("2d");

            // Set canvas dimensions to match video
            canvas.width = cameraFeed.videoWidth;
            canvas.height = cameraFeed.videoHeight;

            // Draw video frame to canvas
            context.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);

            // Switch to preview mode
            showPreviewUI();
        }

        function retakePhoto() {
            showCameraUI();
        }

        function confirmPhoto() {
            // Show loading indicator
            loadingIndicator.style.display = "flex";

            // Simulate processing (would be an API call in real implementation)
            setTimeout(() => {
                // Hide loading indicator
                loadingIndicator.style.display = "none";

                // Close camera
                closeCameraModal();

                // Update attendance record
                if (isCheckingIn) {
                    recordCheckIn();
                } else {
                    recordCheckOut();
                }

                // Show success message
                attendanceSuccess.style.display = "block";
                setTimeout(() => {
                    attendanceSuccess.style.display = "none";
                }, 3000);
            }, 1500);
        }

        function closeCameraModal() {
            cameraModal.style.display = "none";

            // Stop camera stream
            if (mediaStream) {
                mediaStream.getTracks().forEach(track => track.stop());
                mediaStream = null;
            }
        }

        // Record attendance
        function recordCheckIn() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const timeString = `${hours}:${minutes}`;

            checkInTime.textContent = timeString;
            hasCheckedIn = true;
            checkInButton.classList.add("disabled");
            checkOutButton.classList.remove("disabled");
            checkOutButton.addEventListener("click", openCameraForCheckout);
        }

        function recordCheckOut() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const timeString = `${hours}:${minutes}`;

            checkOutTime.textContent = timeString;
            hasCheckedOut = true;
            checkOutButton.classList.add("disabled");
        }

        // Initialize application
        function initApp() {
            setCurrentDate();
            initMap();
            getUserLocation();

            // Set up event listeners
            checkOutButton.classList.add("disabled");
            captureButton.addEventListener("click", capturePhoto);
            closeCamera.addEventListener("click", closeCameraModal);
            retakeButton.addEventListener("click", retakePhoto);
            confirmButton.addEventListener("click", confirmPhoto);
        }

        // Start the application when page loads
        window.addEventListener("load", initApp);
    </script>
</body>

</html>