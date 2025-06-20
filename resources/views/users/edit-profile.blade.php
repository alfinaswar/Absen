<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
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

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-avatar {
            position: relative;
            display: inline-block;
            margin-bottom: 15px;
        }

        .avatar-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            object-fit: cover;
        }

        .avatar-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-color), #4299e1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 600;
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .avatar-edit {
            position: absolute;
            bottom: 0;
            right: 0;
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .avatar-edit:hover {
            background: #2c5aa0;
            transform: scale(1.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            background: white;
            color: var(--text-primary);
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }

        .form-input:disabled {
            background-color: #f7fafc;
            color: var(--text-secondary);
            cursor: not-allowed;
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

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            gap: 8px;
        }

        .btn-primary {
            background: var(--accent-color);
            color: white;
        }

        .btn-primary:hover {
            background: #2c5aa0;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(49, 130, 206, 0.4);
        }

        .btn-secondary {
            background: var(--border-color);
            color: var(--text-primary);
        }

        .btn-secondary:hover {
            background: #cbd5e0;
        }

        .btn-full {
            width: 100%;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            justify-content: center;
            align-items: center;
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

        .file-input {
            display: none;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #f0fff4;
            border: 1px solid #9ae6b4;
            color: #276749;
        }

        .alert-error {
            background-color: #fed7d7;
            border: 1px solid #feb2b2;
            color: #c53030;
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

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .title {
                font-size: 16px;
            }

            .avatar-img,
            .avatar-placeholder {
                width: 100px;
                height: 100px;
            }

            .avatar-placeholder {
                font-size: 40px;
            }

            .avatar-edit {
                width: 32px;
                height: 32px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="back-button" onclick="{{route('home')}}">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </div>
        <div class="title">Update Profile</div>
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
        <!-- Alert Messages -->
        <div id="alert-container"></div>

        <div class="card">
            <div class="card-body">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <div class="avatar-placeholder" id="avatar-display">
                            JD
                        </div>
                        <button class="avatar-edit" onclick="document.getElementById('avatar-input').click()">
                            <i class="fas fa-camera"></i>
                        </button>
                        <input type="file" id="avatar-input" class="file-input" accept="image/*"
                            onchange="handleAvatarChange(event)" name="foto_profile">
                    </div>
                </div>

                <form id="profile-form" onsubmit="handleSubmit(event)">
                    <div class="form-group">
                        <label class="form-label" for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="name" class="form-input" value="{{$user->name}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-input" value="{{$user->email}}"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="shift">Shift</label>
                        <select id="shift" name="shift" class="form-input" required>
                            <option value="">-- Pilih Shift --</option>
                            @foreach($shift as $item)
                                <option value="{{ $item->id }}" {{ $user->shift_kerja == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_shift }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="no_telepon">No. Telepon</label>
                        <input type="tel" id="no_telepon" name="no_telepon" class="form-input"
                            value="{{ $user->no_hp ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-input"
                            value="{{ $user->alamat ?? '' }}">
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="password">Password <span style="font-weight:normal;">(biarkan
                                kosong jika tidak ingin diganti)</span></label>
                        <input type="password" id="password" name="password" class="form-input"
                            autocomplete="new-password">
                    </div>

                    <div class="form-actions text-center">
                        <center>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Simpan Perubahan
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="bottom-nav-items">
            <a href="{{route('home')}}" class="bottom-nav-item">
                <i class="fas fa-home bottom-nav-icon"></i>
                <span class="bottom-nav-label">Home</span>
            </a>
            <a href="{{route('absen.PageAbsen')}}" class="bottom-nav-item">
                <div class="fingerprint-icon">
                    <i class="fas fa-fingerprint"></i>
                </div>
                <span class="bottom-nav-label">Absensi</span>
            </a>
            <a href="#" class="bottom-nav-item">
                <i class="fas fa-chart-bar bottom-nav-icon"></i>
                <span class="bottom-nav-label">Data Absen</span>
            </a>

        </div>
    </div>

    <script>
        function handleAvatarChange(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const avatarDisplay = document.getElementById('avatar-display');
                    avatarDisplay.innerHTML = `<img src="${e.target.result}" alt="Avatar" class="avatar-img">`;
                };
                reader.readAsDataURL(file);
            }
        }

        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alert-container');
            const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
            const alertHTML = `
                <div class="alert ${alertClass}">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                    ${message}
                </div>
            `;
            alertContainer.innerHTML = alertHTML;

            // Auto hide after 5 seconds
            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 5000);
        }

        function handleSubmit(event) {
            event.preventDefault();

            // Simulate form submission
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData.entries());

            // Show loading state
            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                // Show success message
                showAlert('Profile berhasil diperbarui!', 'success');

                // Scroll to top to show alert
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 2000);
        }

        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset semua perubahan?')) {
                document.getElementById('profile-form').reset();

                // Reset avatar
                const avatarDisplay = document.getElementById('avatar-display');
                avatarDisplay.innerHTML = 'JD';

                // Reset form values to original
                document.getElementById('nama').value = 'John Doe';
                document.getElementById('email').value = 'john.doe@example.com';
                document.getElementById('nip').value = '123456789';
                document.getElementById('jabatan').value = 'manager';
                document.getElementById('departemen').value = 'it';
                document.getElementById('no_telepon').value = '+62 812-3456-7890';
                document.getElementById('alamat').value = 'Jl. Sudirman No. 123, Jakarta';
                document.getElementById('tanggal_bergabung').value = '2023-01-15';

                showAlert('Form telah direset ke nilai awal.', 'success');
            }
        }

        // Update avatar initials based on name
        document.getElementById('nama').addEventListener('input', function (e) {
            const name = e.target.value;
            const initials = name.split(' ').map(word => word.charAt(0).toUpperCase()).join('').slice(0, 2);
            const avatarDisplay = document.getElementById('avatar-display');

            // Only update if it's still showing initials (not an uploaded image)
            if (!avatarDisplay.querySelector('img')) {
                avatarDisplay.textContent = initials || 'JD';
            }
        });
    </script>
</body>

</html>