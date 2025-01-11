@extends('layouts.app')

@section('content')
    <div class="page-wrapper mb-3">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Master
                        </div>
                        <h2 class="page-title">
                            Data Karyawan
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">

                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-room" aria-label="Create new report">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">

            <div class="container-xl">

                <div class="card">
                    <div class="card-header bg-azure">
                        <h3 class="card-title">Update Data Karyawan </h3>
                    </div>
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert">{{ session('message') }}</div>
                        @endif

                        <div class="preview-block">

                            <div class="row gy-4">
                                <div class="col-sm-12">


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
                                    {!! Form::model($user, [
                                        'method' => 'PATCH',
                                        'route' => ['users.update', $user->id],
                                        'enctype' => 'multipart/form-data',
                                    ]) !!}
                                    <!-- Informasi Akun -->
                                    <h6 class="mt-3 mb-3">Informasi Akun</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Nama:</strong>
                                                {!! Form::text('name', null, ['placeholder' => 'Nama Lengkap', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Email:</strong>
                                                {!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Kata Sandi Baru:</strong>
                                                {!! Form::password('password', ['placeholder' => 'Kosongkan jika tidak diubah', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Konfirmasi Kata Sandi:</strong>
                                                {!! Form::password('confirm-password', [
                                                    'placeholder' => 'Konfirmasi Kata Sandi Baru',
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informasi Pribadi -->
                                    <h6 class="mt-4 mb-3">Informasi Pribadi</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>NIP:</strong>
                                                {!! Form::text('nip', null, ['placeholder' => 'Nomor Induk Pegawai', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>NIK:</strong>
                                                {!! Form::text('nik', null, ['placeholder' => 'Nomor Induk Kependudukan', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Tempat Lahir:</strong>
                                                {!! Form::text('tempat_lahir', null, ['placeholder' => 'Tempat Lahir', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Tanggal Lahir:</strong>
                                                {!! Form::date('tanggal_lahir', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Jenis Kelamin:</strong>
                                                {!! Form::select('jenis_kelamin', ['L' => 'Laki-laki', 'P' => 'Perempuan'], null, [
                                                    'placeholder' => 'Pilih Jenis Kelamin',
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Agama:</strong>
                                                {!! Form::select(
                                                    'agama',
                                                    [
                                                        'Islam' => 'Islam',
                                                        'Kristen' => 'Kristen',
                                                        'Katolik' => 'Katolik',
                                                        'Hindu' => 'Hindu',
                                                        'Buddha' => 'Buddha',
                                                        'Konghucu' => 'Konghucu',
                                                        'Lainnya' => 'Lainnya',
                                                    ],
                                                    null,
                                                    ['placeholder' => 'Pilih Agama', 'class' => 'form-control'],
                                                ) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Status Pernikahan:</strong>
                                                {!! Form::select('status_pernikahan', ['Lajang' => 'Lajang', 'Menikah' => 'Menikah', 'Cerai' => 'Cerai'], null, [
                                                    'placeholder' => 'Pilih Status',
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>No. HP:</strong>
                                                {!! Form::text('no_hp', null, ['placeholder' => 'Nomor Handphone', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>Foto Profile:</strong>
                                                @if ($user->foto_profile)
                                                    <div class="mb-2">
                                                        <img src="{{ asset($user->foto_profile) }}" alt="Profile"
                                                            class="img-thumbnail" style="max-height: 100px">
                                                    </div>
                                                @endif
                                                {!! Form::file('foto_profile', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kepegawaian -->
                                    <h6 class="mt-4 mb-3">Informasi Kepegawaian</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Jabatan:</strong>
                                                {!! Form::text('jabatan', null, ['placeholder' => 'Jabatan', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Departemen:</strong>
                                                {!! Form::text('departemen', null, ['placeholder' => 'Departemen', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Divisi:</strong>
                                                {!! Form::text('divisi', null, ['placeholder' => 'Divisi', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Status Kepegawaian:</strong>
                                                {!! Form::select(
                                                    'status_kepegawaian',
                                                    ['Tetap' => 'Tetap', 'Kontrak' => 'Kontrak', 'Magang' => 'Magang', 'Outsource' => 'Outsource'],
                                                    null,
                                                    ['placeholder' => 'Pilih Status', 'class' => 'form-control'],
                                                ) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Tanggal Bergabung:</strong>
                                                {!! Form::date('tanggal_bergabung', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Tanggal Berakhir Kontrak:</strong>
                                                {!! Form::date('tanggal_berakhir_kontrak', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Peran:</strong>
                                                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bank & BPJS -->
                                    <h6 class="mt-4 mb-3">Informasi Bank & BPJS</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Nama Bank:</strong>
                                                {!! Form::text('nama_bank', null, ['placeholder' => 'Nama Bank', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>No. Rekening:</strong>
                                                {!! Form::text('no_rekening', null, ['placeholder' => 'Nomor Rekening', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>BPJS Kesehatan:</strong>
                                                {!! Form::text('no_bpjs_kesehatan', null, ['placeholder' => 'Nomor BPJS Kesehatan', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>BPJS Ketenagakerjaan:</strong>
                                                {!! Form::text('no_bpjs_ketenagakerjaan', null, [
                                                    'placeholder' => 'Nomor BPJS Ketenagakerjaan',
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>NPWP:</strong>
                                                {!! Form::text('no_npwp', null, ['placeholder' => 'Nomor NPWP', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-right mt-4">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </div>






@endsection
