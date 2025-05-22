<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi Karyawan</title>
    <link rel="stylesheet" href="{{asset('assets/css/custom-css/index.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    @stack('css')
</head>

<body>
    <div class="container">
        @yield('content')
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.getElementById('menuToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const closeMenu = document.querySelector('.close-menu');

        // Open menu
        menuToggle.addEventListener('click', function () {
            dropdownMenu.classList.add('active');
        });

        // Close menu
        closeMenu.addEventListener('click', function () {
            dropdownMenu.classList.remove('active');
        });
    });
</script>
@stack('js')

</html>