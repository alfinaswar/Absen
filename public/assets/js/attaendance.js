// Configuration - Replace with your actual values
const officeLocation = {
    lat: 0.532777, // Latitude kota Pekanbaru
    lng: 101.444444, // Longitude kota Pekanbaru
};
const officeRadius = 44200; // in meters - adjust as needed

// DOM elements
const locationStatus = document.getElementById("locationStatus");
const locationText = document.getElementById("locationText");
const accuracyText = document.getElementById("accuracyText");
const checkInButton = document.getElementById("checkInButton");
const checkOutButton = document.getElementById("checkOutButton");
const checkInTime = document.getElementById("checkInTime");
const checkOutTime = document.getElementById("checkOutTime");
const currentDateElement = document.getElementById("currentDate");

// Modal elements
const attendanceModal = document.getElementById("attendanceModal");
const modalTitle = document.getElementById("modalTitle");
const closeModal = document.getElementById("closeModal");
const attendanceForm = document.getElementById("attendanceForm");
const shiftGroup = document.getElementById("shiftGroup");
const errorMessage = document.getElementById("errorMessage");

// Camera elements
const cameraFeed = document.getElementById("cameraFeed");
const previewCanvas = document.getElementById("previewCanvas");
const captureButton = document.getElementById("captureButton");
const retakeButton = document.getElementById("retakeButton");
const cancelButton = document.getElementById("cancelButton");
const submitButton = document.getElementById("submitButton");
const submitText = document.getElementById("submitText");

// Form inputs
const latitudeInput = document.getElementById("latitude");
const longitudeInput = document.getElementById("longitude");
const accuracyInput = document.getElementById("accuracy");
const attendanceTypeInput = document.getElementById("attendanceType");
const photoDataInput = document.getElementById("photoData");
const shiftSelect = document.getElementById("shift");

// Other elements
const loadingIndicator = document.getElementById("loadingIndicator");
const attendanceSuccess = document.getElementById("attendanceSuccess");

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
    const days = [
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu",
    ];
    const months = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
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
    map = L.map("map").setView([officeLocation.lat, officeLocation.lng], 16);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    // Add office marker
    const officeIcon = L.icon({
        iconUrl:
            "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-icon.png",
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowUrl:
            "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png",
        shadowSize: [41, 41],
    });

    officeMarker = L.marker([officeLocation.lat, officeLocation.lng], {
        icon: officeIcon,
    }).addTo(map);
    officeMarker.bindPopup("Lokasi Kantor").openPopup();

    // Add office radius
    radiusCircle = L.circle([officeLocation.lat, officeLocation.lng], {
        color: "#233b81",
        fillColor: "#4d69b5",
        fillOpacity: 0.2,
        radius: officeRadius,
    }).addTo(map);
}

// Get user location
function getUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(
            (position) => {
                userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
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
                showError(
                    "Tidak dapat mengakses lokasi Anda. Pastikan GPS aktif dan izin lokasi diberikan."
                );
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0,
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
            className: "user-marker",
            html: `<div style="background-color: #1E88E5; width: 16px; height: 16px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px #1E88E5;"></div>`,
            iconSize: [24, 24],
            iconAnchor: [12, 12],
        });

        userMarker = L.marker([userLocation.lat, userLocation.lng], {
            icon: userIcon,
            zIndexOffset: 1000,
        }).addTo(map);
    }

    // Fit map bounds to show both office and user
    const bounds = L.latLngBounds([
        [officeLocation.lat, officeLocation.lng],
        [userLocation.lat, userLocation.lng],
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
    const φ1 = (officeLocation.lat * Math.PI) / 180;
    const φ2 = (userLocation.lat * Math.PI) / 180;
    const Δφ = ((userLocation.lat - officeLocation.lat) * Math.PI) / 180;
    const Δλ = ((userLocation.lng - officeLocation.lng) * Math.PI) / 180;

    const a =
        Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
        Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    const distance = R * c;

    isWithinRadius = distance <= officeRadius;

    // Update UI
    if (isWithinRadius) {
        locationText.textContent = "Anda berada di dalam radius kantor";
        locationStatus.classList.remove("outside");
        enableAttendanceButtons();
    } else {
        locationText.textContent = `Anda berada di luar radius kantor (${Math.round(
            distance
        )}m dari kantor)`;
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
    errorMessage.style.display = "block";
    setTimeout(() => {
        errorMessage.style.display = "none";
    }, 5000);
}

// Show success message
function showSuccess(message) {
    attendanceSuccess.textContent = message;
    attendanceSuccess.style.display = "block";
    setTimeout(() => {
        attendanceSuccess.style.display = "none";
    }, 3000);
}

// Modal functions
function openAttendanceModal(type) {
    if (!isWithinRadius) {
        showError(
            "Anda harus berada di dalam radius kantor untuk melakukan absensi."
        );
        return;
    }

    if (!userLocation) {
        showError("Lokasi belum terdeteksi. Tunggu sebentar dan coba lagi.");
        return;
    }

    attendanceTypeInput.value = type;

    if (type === "checkin") {
        modalTitle.textContent = "Absen Masuk";
        shiftGroup.style.display = "block";
        submitText.textContent = "Absen Masuk";
    } else {
        modalTitle.textContent = "Absen Keluar";
        shiftGroup.style.display = "none";
        submitText.textContent = "Absen Keluar";
    }

    // Set location data
    latitudeInput.value = userLocation.lat;
    longitudeInput.value = userLocation.lng;
    accuracyInput.value = locationAccuracy;

    // Reset form
    resetCameraState();
    capturedPhotoData = null;
    submitButton.disabled = true;

    attendanceModal.style.display = "flex";
    startCamera();
}

function closeAttendanceModal() {
    attendanceModal.style.display = "none";
    stopCamera();
    resetForm();
}

function resetForm() {
    attendanceForm.reset();
    capturedPhotoData = null;
    resetCameraState();
    errorMessage.style.display = "none";
}

// Camera functions
function startCamera() {
    navigator.mediaDevices
        .getUserMedia({
            video: {
                facingMode: "user",
                width: { ideal: 640 },
                height: { ideal: 480 },
            },
            audio: false,
        })
        .then((stream) => {
            mediaStream = stream;
            cameraFeed.srcObject = stream;
            cameraFeed.play();
        })
        .catch((error) => {
            console.error("Error accessing camera:", error);
            showError(
                "Tidak dapat mengakses kamera. Pastikan izin kamera diberikan."
            );
        });
}

function stopCamera() {
    if (mediaStream) {
        mediaStream.getTracks().forEach((track) => track.stop());
        mediaStream = null;
    }
}

function resetCameraState() {
    cameraFeed.style.display = "block";
    previewCanvas.style.display = "none";
    captureButton.style.display = "inline-flex";
    retakeButton.style.display = "none";
}

function capturePhoto() {
    if (!mediaStream) {
        showError("Kamera belum siap. Coba lagi dalam beberapa detik.");
        return;
    }

    const canvas = previewCanvas;
    const context = canvas.getContext("2d");

    // Set canvas dimensions to match video
    canvas.width = cameraFeed.videoWidth;
    canvas.height = cameraFeed.videoHeight;

    // Draw video frame to canvas
    context.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);

    // Convert to base64
    capturedPhotoData = canvas.toDataURL("image/jpeg", 0.8);
    photoDataInput.value = capturedPhotoData;

    // Switch to preview mode
    showPreview();

    // Enable submit button if all requirements are met
    checkFormValidity();
}

function showPreview() {
    cameraFeed.style.display = "none";
    previewCanvas.style.display = "block";
    captureButton.style.display = "none";
    retakeButton.style.display = "inline-flex";
}

function retakePhoto() {
    resetCameraState();
    capturedPhotoData = null;
    photoDataInput.value = "";
    submitButton.disabled = true;
}

function checkFormValidity() {
    const isPhotoTaken = capturedPhotoData !== null;
    const isShiftSelected =
        attendanceTypeInput.value === "checkout" || shiftSelect.value !== "";

    submitButton.disabled = !(isPhotoTaken && isShiftSelected);
}

// Form submission
function handleFormSubmit(event) {
    event.preventDefault();

    if (!capturedPhotoData) {
        showError("Silakan ambil foto terlebih dahulu.");
        return;
    }

    if (attendanceTypeInput.value === "checkin" && !shiftSelect.value) {
        showError("Silakan pilih shift terlebih dahulu.");
        return;
    }

    // Show loading
    loadingIndicator.style.display = "flex";

    // Prepare form data
    const formData = new FormData();
    formData.append(
        "_token",
        document.querySelector('input[name="_token"]').value
    );
    formData.append("type", attendanceTypeInput.value);
    formData.append("latitude", latitudeInput.value);
    formData.append("longitude", longitudeInput.value);
    formData.append("accuracy", accuracyInput.value);

    if (attendanceTypeInput.value === "checkin") {
        formData.append("shift_id", shiftSelect.value);
    }

    // Convert base64 image to blob
    const photoBlob = dataURLtoBlob(capturedPhotoData);
    formData.append("photo", photoBlob, "selfie.jpg");

    // Submit to server
    fetch("/absen", {
        method: "POST",
        body: formData,
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            loadingIndicator.style.display = "none";

            if (data.success) {
                closeAttendanceModal();
                updateAttendanceStatus(attendanceTypeInput.value);
                showSuccess(data.message || "Absensi berhasil dicatat!");
            } else {
                showError(
                    data.message || "Terjadi kesalahan saat mencatat absensi."
                );
            }
        })
        .catch((error) => {
            loadingIndicator.style.display = "none";
            console.error("Error:", error);
            showError(
                "Terjadi kesalahan saat mengirim data. Periksa koneksi internet Anda."
            );
        });
}

// Helper function to convert base64 to blob
function dataURLtoBlob(dataurl) {
    const arr = dataurl.split(",");
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8arr = new Uint8Array(n);
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], { type: mime });
}

// Update attendance status after successful submission
function updateAttendanceStatus(type) {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, "0");
    const minutes = String(now.getMinutes()).padStart(2, "0");
    const timeString = `${hours}:${minutes}`;

    if (type === "checkin") {
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
    checkInButton.addEventListener("click", () => {
        if (!checkInButton.classList.contains("disabled")) {
            openAttendanceModal("checkin");
        }
    });

    // Check-out button
    checkOutButton.addEventListener("click", () => {
        if (!checkOutButton.classList.contains("disabled")) {
            openAttendanceModal("checkout");
        }
    });

    // Modal controls
    closeModal.addEventListener("click", closeAttendanceModal);
    cancelButton.addEventListener("click", closeAttendanceModal);

    // Camera controls
    captureButton.addEventListener("click", capturePhoto);
    retakeButton.addEventListener("click", retakePhoto);

    // Form controls
    attendanceForm.addEventListener("submit", handleFormSubmit);
    shiftSelect.addEventListener("change", checkFormValidity);

    // Close modal when clicking outside
    attendanceModal.addEventListener("click", (e) => {
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

    // Initially disable check-out button
    checkOutButton.classList.add("disabled");
}

// Start the application when page loads
window.addEventListener("load", initApp);
