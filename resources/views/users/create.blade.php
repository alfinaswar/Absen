@extends('layouts.app')
@section('content')
    <div class="page-wrapper mb-3">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Tambah Data</div>
                        <h2 class="page-title">Master Perusahaan</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #1F573A;">
                        <h3 class="card-title">Form Tambah Master Perusahaan</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Informasi Dasar -->
                            <h6 class="mt-3 mb-3">Informasi Dasar</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Nama Lengkap:</strong>
                                        <input type="text" name="name" placeholder="Nama Lengkap" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Jenis Kelamin:</strong>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Tempat Lahir:</strong>
                                        <input type="text" name="tempat_lahir" placeholder="Tempat Lahir"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Tanggal Lahir:</strong>
                                        <input type="date" name="tanggal_lahir" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Alamat Domisili:</strong>
                                        <textarea name="alamat_domisili" placeholder="Alamat Domisili" class="form-control"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Nomor WhatsApp:</strong>
                                        <input type="text" name="no_hp" placeholder="Nomor WhatsApp" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Alamat Email:</strong>
                                        <input type="email" name="email" placeholder="Alamat Email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Password:</strong>
                                        <input type="password" name="password" placeholder="Password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Hak Akses:</strong>
                                        <select name="role" class="form-control">
                                            <option value="">Pilih Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Kerja -->
                            <h6 class="mt-4 mb-3">Informasi Kerja</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Area Kerja / Nama Perusahaan:</strong>
                                        <select name="IdPerusahaan" id="select-perusahaan" class="form-control">
                                            <option value="">Pilih Perusahaan</option>
                                            @foreach ($perusahaan as $per)
                                                <option value="{{ $per->id }}">{{ $per->Nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Nomor Induk Karyawan (NIK):</strong>
                                        <input type="text" name="nik" placeholder="Nomor Induk Karyawan"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Jabatan:</strong>
                                        <input type="text" name="jabatan" placeholder="Jabatan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Bagian / Departemen:</strong>
                                        <input type="text" name="departemen" placeholder="Bagian / Departemen"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Status Karyawan:</strong>
                                        <select name="status_kepegawaian" class="form-control">
                                            <option value="">Pilih Status Karyawan</option>
                                            @foreach ($status as $st)
                                                <option value="{{ $st->id }}">{{ $st->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Status Kontrak:</strong>
                                        <select name="is_active" class="form-control">
                                            <option value="">Pilih Status Kontrak</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Tanggal Mulai Bekerja:</strong>
                                        <input type="date" name="tanggal_bergabung" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Tanggal Berakhir Bekerja:</strong>
                                        <input type="date" name="tanggal_berakhir_kontrak" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Shift Kerja:</strong>
                                        <select name="shift_kerja" class="form-control">
                                            <option value="">Pilih Shift Kerja</option>
                                            @foreach ($shift as $s)
                                                <option value="{{ $s->id }}">{{ $s->nama_shift }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </< /div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            var el;
            window.TomSelect && (new TomSelect(el = document.getElementById('select-perusahaan'), {
                copyClassesToDropdown: false,
                dropdownParent: 'body',
                controlInput: '<input>',
                render: {
                    item: function (data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function (data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
            }));
        });
    </script>
@endpush