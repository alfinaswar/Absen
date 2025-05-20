<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/custom-css/PageAbsen.css')}}">
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
@push('js')
    <!-- Include Leaflet CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script>
        let map, marker, circle, userLatitude, userLongitude, userLocationAddress;
        let confirmedInOfficeArea = false;
        let currentAbsenType = null;
        // Office coordinates (example - replace with your actual office coordinates)
        const officeLatitude = {{$dataKaryawan->getPerusahaan->Latitude ?? '-6.2088'}}; // Jakarta example coordinate
        const officeLongitude = {{$dataKaryawan->getPerusahaan->Longitude ?? '106.8456'}}; // Jakarta example coordinate
        const maxDistanceMeters = 75; // Maximum allowed distance from office in meters

        // Camera variables
        let cameraStream = null;
        let cameraView = null;
        let cameraCanvas = null;
        let cameraOutput = null;

        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map
            map = L.map('map').setView([-6.2088, 106.8456], 15); // Default ke Jakarta

            // Add tile layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add office marker
            const officeIcon = L.icon({
                iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            const officeMarker = L.marker([officeLatitude, officeLongitude], { icon: officeIcon }).addTo(map);
            officeMarker.bindPopup("Lokasi Kantor").openPopup();

            // Define allowed radius
            const allowedRadius = L.circle([officeLatitude, officeLongitude], {
                color: 'green',
                fillColor: '#0f8',
                fillOpacity: 0.2,
                radius: maxDistanceMeters
            }).addTo(map);

            // Get user's current location
            getUserLocation();

            // Set up the modal confirmation button
            document.getElementById('confirm-btn').addEventListener('click', function () {
                document.getElementById('attendance-form').submit();
            });

            // Initialize camera elements
            cameraView = document.getElementById('camera-view');
            cameraCanvas = document.getElementById('camera-canvas');
            cameraOutput = document.getElementById('camera-output');

            // Capture button click event
            document.getElementById('capture-btn').addEventListener('click', function () {
                takeSelfie();
            });

            // Retake photo button
            document.getElementById('retake-photo').addEventListener('click', function () {
                // Reset UI
                document.getElementById('camera-output').style.display = 'none';
                document.getElementById('camera-view').style.display = 'block';
                document.getElementById('capture-btn').style.display = 'block';
                document.getElementById('submit-photo').style.display = 'none';
                document.getElementById('retake-photo').style.display = 'none';
            });

            // Submit photo button
            document.getElementById('submit-photo').addEventListener('click', function () {
                const modal = new bootstrap.Modal(document.getElementById('confirmAttendanceModal'));
                const cameraModal = bootstrap.Modal.getInstance(document.getElementById('cameraModal'));

                // Get the selfie data
                const selfieData = document.getElementById('camera-output').src;
                document.getElementById('selfie_photo').value = selfieData;

                // Close camera modal
                cameraModal.hide();

                // Show confirmation modal
                document.getElementById('confirm-message').innerHTML =
                    currentAbsenType === 'masuk'
                        ? "Anda akan melakukan absen masuk. Lanjutkan?"
                        : "Anda akan melakukan absen keluar. Lanjutkan?";

                modal.show();
            });

            // Handle camera modal closing
            document.getElementById('cameraModal').addEventListener('hidden.bs.modal', function () {
                stopCamera();
            });
        });

        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        userLatitude = position.coords.latitude;
                        userLongitude = position.coords.longitude;

                        // If marker already exists, update position, otherwise create new
                        if (marker) {
                            marker.setLatLng([userLatitude, userLongitude]);
                        } else {
                            marker = L.marker([userLatitude, userLongitude]).addTo(map);
                        }

                        // Set map view to user location
                        map.setView([userLatitude, userLongitude], 15);

                        // Calculate distance to office
                        const distance = calculateDistance(
                            userLatitude, userLongitude,
                            officeLatitude, officeLongitude
                        );

                        // Update user's location info
                        getAddressFromCoordinates(userLatitude, userLongitude);

                        // Check if user is within allowed distance
                        if (distance <= maxDistanceMeters) {
                            document.getElementById('location-status').className = 'alert alert-success';
                            document.getElementById('location-status').innerHTML =
                                `<strong>Lokasi Valid!</strong> Anda berada dalam radius kantor (${Math.round(distance)}m dari kantor)`;
                            confirmedInOfficeArea = true;
                        } else {
                            document.getElementById('location-status').className = 'alert alert-danger';
                            document.getElementById('location-status').innerHTML =
                                `<strong>Lokasi Tidak Valid!</strong> Anda berada di luar radius kantor (${Math.round(distance)}m dari kantor)`;
                            confirmedInOfficeArea = false;
                        }
                    },
                    function (error) {
                        console.error("Error getting location: ", error);
                        document.getElementById('location-status').className = 'alert alert-danger';
                        document.getElementById('location-status').innerHTML =
                            `<strong>Error!</strong> Tidak dapat mengakses lokasi Anda. ${error.message}`;
                    },
                    { enableHighAccuracy: true }
                );
            } else {
                document.getElementById('location-status').className = 'alert alert-danger';
                document.getElementById('location-status').innerHTML =
                    "<strong>Error!</strong> Geolocation tidak didukung oleh browser Anda.";
            }
        }

        function getAddressFromCoordinates(lat, lng) {
            // Using Nominatim Reverse Geocoding API
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    userLocationAddress = data.display_name;
                })
                .catch(error => {
                    console.error("Error getting address: ", error);
                    userLocationAddress = `Latitude: ${lat}, Longitude: ${lng}`;
                });
        }

        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371e3; // Earth radius in meters
            const φ1 = lat1 * Math.PI / 180; // φ, λ in radians
            const φ2 = lat2 * Math.PI / 180;
            const Δφ = (lat2 - lat1) * Math.PI / 180;
            const Δλ = (lon2 - lon1) * Math.PI / 180;

            const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            return R * c; // distance in meters
        }

        function checkLocationMasuk() {
            // Re-check location before proceeding
            getUserLocation();
            currentAbsenType = 'masuk';

            setTimeout(() => {
                if (confirmedInOfficeArea) {
                    // Prepare the data for submission
                    document.getElementById('latitude').value = userLatitude;
                    document.getElementById('longitude').value = userLongitude;
                    document.getElementById('lokasi').value = userLocationAddress;
                    document.getElementById('tipe_absen').value = 'masuk';

                    // If location is valid, open camera for selfie
                    openCamera();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lokasi Tidak Valid',
                        text: 'Anda harus berada dalam radius kantor untuk melakukan absensi!',
                    });
                }
            }, 1000); // Short delay to allow location check to complete
        }

        function checkLocationKeluar() {
            // Re-check location before proceeding
            getUserLocation();
            currentAbsenType = 'keluar';

            setTimeout(() => {
                if (confirmedInOfficeArea) {
                    // Prepare the data for submission
                    document.getElementById('latitude').value = userLatitude;
                    document.getElementById('longitude').value = userLongitude;
                    document.getElementById('lokasi').value = userLocationAddress;
                    document.getElementById('tipe_absen').value = 'keluar';

                    // If location is valid, open camera for selfie
                    openCamera();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lokasi Tidak Valid',
                        text: 'Anda harus berada dalam radius kantor untuk melakukan absensi!',
                    });
                }
            }, 1000); // Short delay to allow location check to complete
        }

        function openCamera() {
            const cameraModal = new bootstrap.Modal(document.getElementById('cameraModal'));

            // Reset UI elements
            document.getElementById('camera-view').style.display = 'block';
            document.getElementById('camera-output').style.display = 'none';
            document.getElementById('capture-btn').style.display = 'block';
            document.getElementById('submit-photo').style.display = 'none';
            document.getElementById('retake-photo').style.display = 'none';

            cameraModal.show();

            // Start the camera
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "user",
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    },
                    audio: false
                })
                    .then(function (stream) {
                        cameraStream = stream;
                        cameraView.srcObject = stream;
                    })
                    .catch(function (error) {
                        console.error("Camera error: ", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Kamera Error',
                            text: 'Tidak dapat mengakses kamera. Mohon izinkan akses kamera.',
                        });
                    });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Browser Tidak Mendukung',
                    text: 'Browser Anda tidak mendukung akses kamera.',
                });
            }
        }

        function stopCamera() {
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => {
                    track.stop();
                });
                cameraStream = null;
            }
        }

        function takeSelfie() {
            // Set canvas dimensions to match video
            cameraCanvas.width = cameraView.videoWidth;
            cameraCanvas.height = cameraView.videoHeight;

            // Draw the video frame to the canvas
            cameraCanvas.getContext('2d').drawImage(cameraView, 0, 0, cameraCanvas.width, cameraCanvas.height);

            // Get the data URL from the canvas
            const dataURL = cameraCanvas.toDataURL('image/jpeg');

            // Set the src of the img element to the data URL
            cameraOutput.src = dataURL;

            // Show the captured image and hide the video stream
            cameraView.style.display = 'none';
            cameraOutput.style.display = 'block';

            // Update buttons
            document.getElementById('capture-btn').style.display = 'none';
            document.getElementById('submit-photo').style.display = 'inline-block';
            document.getElementById('retake-photo').style.display = 'inline-block';
        }

        function ShowCuti() {
            $("#cutiform").show();
        }

        // Update the clock every second
        setInterval(function () {
            document.getElementById('current-time').innerHTML = new Date().toLocaleTimeString();
        }, 1000);

        // Refresh location every 30 seconds
        setInterval(function () {
            getUserLocation();
        }, 30000);
    </script>
@endpush