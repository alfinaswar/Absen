<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Absensi</title>
    <link href="{{ asset('') }}assets/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/demo.min.css?1692870487" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .custom-button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <script src="{{ asset('') }}assets/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h5 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href=".">
                        <img src="{{ asset('assets/img/icon/login-logo.png') }}" width="1000" height="1000"
                            alt="Tabler" class="navbar-brand-image">
                    </a>
                    <span style="color: #1F573A; font-size: 18px">Sistem Absensi</span>
                </h5>

                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item d-none d-md-flex me-3">
                        <div class="btn-list">

                        </div>
                    </div>
                    <div class="d-none d-md-flex">
                        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                            </svg>
                        </a>
                        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path
                                    d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                            </svg>
                        </a>

                    </div>
                    <div class="nav-item dropdown">

                        <a href="{{ route('logout') }}" class="nav-link d-flex lh-1 text-reset p-0"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="avatar avatar-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="#2465ff"
                                    class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                                    <path
                                        d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                                </svg></span>
                            <div class="d-none d-xl-block ps-2">
                                <div>Logout</div>
                            </div>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Home
                                    </span>
                                </a>
                            </li>
                            @can('kelola-karyawan')
                                <li class="nav-item dropdown {{ request()->segment(2) == 'users' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('users.index') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3 21l18 0" />
                                                <path d="M5 21v-14l8 -4v18" />
                                                <path d="M19 21v-10l-6 -4" />
                                                <path d="M9 9l0 .01" />
                                                <path d="M9 12l0 .01" />
                                                <path d="M9 15l0 .01" />
                                                <path d="M9 18l0 .01" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Kelola Karyawan
                                        </span>
                                    </a>

                                </li>
                            @endcan
                            @can('monitoring-absen')
                                <li
                                    class="nav-item dropdown {{ request()->segment(2) == 'kelola-absen' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('absen.index') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3 21l18 0" />
                                                <path d="M5 21v-14l8 -4v18" />
                                                <path d="M19 21v-10l-6 -4" />
                                                <path d="M9 9l0 .01" />
                                                <path d="M9 12l0 .01" />
                                                <path d="M9 15l0 .01" />
                                                <path d="M9 18l0 .01" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Monitoring Absen
                                        </span>
                                    </a>

                                </li>
                            @endcan
                            @can('data-laporan')
                                <li
                                    class="nav-item dropdown {{ request()->segment(2) == 'kelola-absen' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('absen.index') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3 21l18 0" />
                                                <path d="M5 21v-14l8 -4v18" />
                                                <path d="M19 21v-10l-6 -4" />
                                                <path d="M9 9l0 .01" />
                                                <path d="M9 12l0 .01" />
                                                <path d="M9 15l0 .01" />
                                                <path d="M9 18l0 .01" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Data Laporan
                                        </span>
                                    </a>

                                </li>
                            @endcan
                            @can('kelola-pengajuan')
                                <li
                                    class="nav-item dropdown {{ request()->segment(2) == 'kelola-absen' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('absen.index') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3 21l18 0" />
                                                <path d="M5 21v-14l8 -4v18" />
                                                <path d="M19 21v-10l-6 -4" />
                                                <path d="M9 9l0 .01" />
                                                <path d="M9 12l0 .01" />
                                                <path d="M9 15l0 .01" />
                                                <path d="M9 18l0 .01" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Kelola Pengajuan
                                        </span>
                                    </a>

                                </li>
                            @endcan

                        </ul>

                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            <main class="py-3">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('') }}assets/libs/apexcharts/dist/apexcharts.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/libs/jsvectormap/dist/maps/world.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/libs/jsvectormap/dist/maps/world-merc.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/dist/libs/nouislider/dist/nouislider.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/dist/libs/tom-select/dist/js/tom-select.base.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/dist/libs/litepicker/dist/litepicker.js?1692870487" defer></script>
    <!-- Tabler Core -->
    <script src="{{ asset('') }}assets/js/tabler.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/js/demo.min.js?1692870487" defer></script>

</body>

</html>
