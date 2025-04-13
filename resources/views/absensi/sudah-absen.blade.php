@extends('layouts.app')
@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <!-- BEGIN NAVBAR LOGO -->

                <!-- END NAVBAR LOGO -->
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="mb-3">Anda sudah absen, tidak bisa absen 2 kali!</h2>
                    <p class="text-secondary mb-4">Anda telah melakukan absen sebelumnya. Silakan tunggu hingga waktu absen
                        berikutnya.</p>
                    <div class="my-4">
                        <a href="{{ route('home') }}" class="btn btn-primary w-100"> Kembali </a>
                    </div>
                    <p class="text-secondary">Jika Anda memerlukan bantuan, jangan ragu untuk <a href="#">menghubungi
                            kami</a>.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
