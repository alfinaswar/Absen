@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-white" style="background-color: #1F573A;">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Selamat Datang</h3>
                        <p>Selamat Datang di Sistem Absensi</p>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                                                <path
                                                    d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                                            </svg> </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Jumlah Karyawan
                                        </div>
                                        <div class="text-secondary">
                                            Jumlah Karyawan : {{ $countKaryawan }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M17 17h-11v-14h-2" />
                                                <path d="M6 5l14 1l-1 7h-13" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Absen Tepat Waktu
                                        </div>
                                        <div class="text-secondary">
                                            {{ $countOntime }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-stats">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                                                <path d="M18 14v4h4" />
                                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                <path d="M15 3v4" />
                                                <path d="M7 3v4" />
                                                <path d="M3 11h16" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Absen Izin
                                        </div>
                                        <div class="text-secondary">
                                            {{ $CountIzin }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart-dollar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M13 17h-7v-14h-2" />
                                            <path d="M6 5l14 1l-.575 4.022m-4.925 2.978h-8.5" />
                                            <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                            <path d="M19 21v1m0 -8v1" />
                                        </svg>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Total Jumlah Absen
                                        </div>
                                        <div class="text-secondary">
                                            {{ $total }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card mt-3">
            <div class="card-body">
                <div class="row mt-4 ">
                    <div class="col-12">
                        <h1 class="text-center mb-3">Absen Berdasarkan Lokasi</h1>
                        <!-- Leaflet map container -->
                        <div id="map" style="height: 400px; width: 100%; border-radius: 8px;"></div>

                        <div class="mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-info" id="location-status">
                                        Mencari lokasi Anda...
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-success w-100" id="btn-masuk" onclick="absenMasuk()">Absen
                                        Masuk</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-danger w-100" id="btn-keluar" onclick="absenKeluar()">Absen
                                        Keluar</button>
                                </div>
                            </div>
                        </div>

                        <div id="current-time" class="text-center mt-3" style="font-size: 24px; font-weight: bold;">
                            {{ now() }}
                        </div>
                    </div>

                </div>
                <button class="btn btn-primary w-100 mt-3" onclick="ShowCuti()">Ajukan Cuti</button>
            </div>
        </div>
        <div class="card mt-5" id="cutiform" style="display: none;">
            <div class="card-header text-center">
                <h2>Formulir Pengajuan Cuti</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('absen.Cutistore') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Nama -->
                        <div class="col-12 mb-3">
                            <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Masukkan nama lengkap" value="{{ auth()->user()->name }}" required>
                        </div>

                        <!-- Tanggal Mulai -->
                        <div class="col-6 mb-3">
                            <label for="start_date" class="form-label fw-bold">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>

                        <!-- Tanggal Selesai -->
                        <div class="col-6 mb-3">
                            <label for="end_date" class="form-label fw-bold">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                            <input type="hidden" name="status" value="CUTI">
                        </div>

                        <!-- Alasan -->
                        <div class="col-12 mb-3">
                            <label for="reason" class="form-label fw-bold">Alasan Cuti</label>
                            <textarea name="keterangan" id="reason" class="form-control" rows="4"
                                placeholder="Jelaskan alasan cuti Anda" required></textarea>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary fw-bold px-4">Ajukan Cuti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal konfirmasi absensi -->
    <div class="modal fade" id="confirmAttendanceModal" tabindex="-1" aria-labelledby="confirmAttendanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmAttendanceModalLabel">Konfirmasi Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="confirm-message">Apakah Anda yakin ingin melakukan absensi?</p>
                    <form id="attendance-form" action="{{ route('absen.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <input type="hidden" name="lokasi" id="lokasi">
                        <input type="hidden" name="tipe_absen" id="tipe_absen">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirm-btn">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'success',
                text: '{{ $message }}',
            });
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'error',
                text: '{{ $message }}',
            });
        </script>
    @endif
@endsection
@push('js')
    <!-- Include Leaflet CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script>
        let map, marker, circle, userLatitude, userLongitude, userLocationAddress;
        let confirmedInOfficeArea = false;
        // Office coordinates (example - replace with your actual office coordinates)
        const officeLatitude = 0.5208882; // Jakarta example coordinate
        const officeLongitude = 101.4431991; // Jakarta example coordinate
        const maxDistanceMeters = 1000; // Maximum allowed distance from office in meters

        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map
            map = L.map('map').setView([-6.2088, 106.8456], 15); // Default to Jakarta

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
                    document.getElementById('current-location').textContent = userLocationAddress;
                })
                .catch(error => {
                    console.error("Error getting address: ", error);
                    userLocationAddress = `Latitude: ${lat}, Longitude: ${lng}`;
                    document.getElementById('current-location').textContent = userLocationAddress;
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

        function absenMasuk() {
            // Re-check location before submitting
            getUserLocation();

            setTimeout(() => {
                const modal = new bootstrap.Modal(document.getElementById('confirmAttendanceModal'));
                if (confirmedInOfficeArea) {
                    document.getElementById('confirm-message').innerHTML = "Anda akan melakukan absen masuk. Lanjutkan?";
                    document.getElementById('latitude').value = userLatitude;
                    document.getElementById('longitude').value = userLongitude;
                    document.getElementById('lokasi').value = userLocationAddress;
                    document.getElementById('tipe_absen').value = 'masuk';
                    modal.show();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lokasi Tidak Valid',
                        text: 'Anda harus berada dalam radius kantor untuk melakukan absensi!',
                    });
                }
            }, 1000); // Short delay to allow location check to complete
        }

        function absenKeluar() {
            // Re-check location before submitting
            getUserLocation();

            setTimeout(() => {
                const modal = new bootstrap.Modal(document.getElementById('confirmAttendanceModal'));
                if (confirmedInOfficeArea) {
                    document.getElementById('confirm-message').innerHTML = "Anda akan melakukan absen keluar. Lanjutkan?";
                    document.getElementById('latitude').value = userLatitude;
                    document.getElementById('longitude').value = userLongitude;
                    document.getElementById('lokasi').value = userLocationAddress;
                    document.getElementById('tipe_absen').value = 'keluar';
                    modal.show();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lokasi Tidak Valid',
                        text: 'Anda harus berada dalam radius kantor untuk melakukan absensi!',
                    });
                }
            }, 1000); // Short delay to allow location check to complete
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
