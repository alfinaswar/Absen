@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Pengaturan Akun
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-md-3 border-end">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    @if($user->foto_profile)
                                        <span class="avatar avatar-xl mb-3"
                                            style="background-image: url({{ asset($user->foto_profile) }})"></span>
                                    @else
                                        <span class="avatar avatar-xl mb-3"
                                            style="background-image: url({{ asset('assets/img/default-avatar.jpg') }})"></span>
                                    @endif
                                    <h4>{{ $user->name }}</h4>
                                    <p class="text-muted">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-9 d-flex flex-column">
                            {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'enctype' => 'multipart/form-data']) !!}
                            <div class="card-body">
                                <h2 class="mb-4">Akun Saya</h2>

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> Periksa Data Inputan Anda<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <h3 class="card-title">Detail Profil</h3>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nama Lengkap</label>
                                            {!! Form::text('name', null, ['placeholder' => 'Nama Lengkap', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            {!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <h3 class="card-title mt-4">Informasi Pribadi</h3>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">NIK</label>
                                            {!! Form::text('nik', null, ['placeholder' => 'Nomor Induk Kependudukan', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Tempat Lahir</label>
                                            {!! Form::text('tempat_lahir', null, ['placeholder' => 'Tempat Lahir', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Lahir</label>
                                            {!! Form::date('tanggal_lahir', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Kelamin</label>
                                            {!! Form::select('jenis_kelamin', ['L' => 'Laki-laki', 'P' => 'Perempuan'], null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Agama</label>
                                            {!! Form::select('agama', ['Islam' => 'Islam', 'Kristen' => 'Kristen', 'Katolik' => 'Katolik', 'Hindu' => 'Hindu', 'Buddha' => 'Buddha', 'Konghucu' => 'Konghucu'], null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status Perkawinan</label>
                                            {!! Form::select('status_perkawinan', ['Belum Menikah' => 'Belum Menikah', 'Menikah' => 'Menikah', 'Cerai Hidup' => 'Cerai Hidup', 'Cerai Mati' => 'Cerai Mati'], null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Nomor HP</label>
                                            {!! Form::text('no_hp', null, ['placeholder' => 'Nomor HP', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Alamat</label>
                                            {!! Form::textarea('alamat', null, ['placeholder' => 'Alamat', 'class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Kepegawaian -->




                                <h3 class="card-title mt-4">Kata Sandi</h3>
                                <p class="card-subtitle">Anda dapat mengatur kata sandi permanen jika tidak ingin
                                    menggunakan kode masuk sementara.</p>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Kata Sandi Baru</label>
                                            {!! Form::password('password', ['placeholder' => 'Kosongkan jika tidak diubah', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Konfirmasi Kata Sandi</label>
                                            {!! Form::password('confirm-password', ['placeholder' => 'Konfirmasi Kata Sandi Baru', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <h3 class="card-title mt-4">Foto Profil</h3>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::file('foto_profile', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="{{ route('home') }}" class="btn">
                                        Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection