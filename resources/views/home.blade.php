@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-white" style="background-color: #1F573A;">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
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
                                            Jumlah User
                                        </div>
                                        <div class="text-secondary">
                                            Jumlah User : 23
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                            23
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
                                            23
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
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
                                            23
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
                <div class="row mt-4 text-center">

                    <div class="col-6">
                        <h1>Scan Disini Untuk Absen</h1>
                        <a href="javascript:void(0)" id="container">{!! $qrCodes !!}</a><br /><br />
                        <div id="current-time" style="font-size: 24px; font-weight: bold;">{{ now() }}</div>

                    </div>
                    <div class="col-6 d-flex align-items-center">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold" style="font-size: 25px;">
                                    Jam Masuk
                                </div>
                                <div class="text-secondary" style="font-size: 25px;">
                                    {{ now()->format('H:i:s') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="fw-bold" style="font-size: 25px;">
                                    Jam Keluar
                                </div>
                                <div class="text-secondary" style="font-size: 25px;">
                                    {{ now()->format('H:i:s') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="fw-bold" style="font-size: 25px;">
                                    Ontime atau Tidak
                                </div>
                                <div class="text-secondary" style="font-size: 25px;">
                                    @if (now()->format('H:i:s') <= '08:00:00')
                                        Tidak
                                    @else
                                        Ontime
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    setInterval(function() {
        document.getElementById('current-time').innerHTML = new Date().toLocaleTimeString();
    }, 1000);
</script>
