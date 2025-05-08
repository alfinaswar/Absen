@extends('layouts.app')


@section('content')
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'success',
                text: '{{ $message }}',
            });
        </script>
    @endif
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
                            <a href="{{route('users.create')}}" class="btn btn-primary d-none d-sm-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Tambah karyawan
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
                    <div class="card-header text-white" style="background-color: #1F573A;">
                        <h3 class="card-title">Daftar User </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th>Divisi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modalForm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Karyawan</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Tutup">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

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
                                <strong>Kata Sandi:</strong>
                                {!! Form::password('password', ['placeholder' => 'Kata Sandi', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Konfirmasi Kata Sandi:</strong>
                                {!! Form::password('confirm-password', ['placeholder' => 'Konfirmasi Kata Sandi', 'class' => 'form-control']) !!}
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
                                {!! Form::file('foto_profile', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <h6 class="mt-4 mb-3">Alamat KTP</h6>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Alamat KTP:</strong>
                                {!! Form::textarea('alamat_ktp', null, [
        'placeholder' => 'Alamat sesuai KTP',
        'class' => 'form-control',
        'rows' => 3,
    ]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Provinsi:</strong>
                                {!! Form::text('provinsi_ktp', null, ['placeholder' => 'Provinsi', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Kota/Kabupaten:</strong>
                                {!! Form::text('kota_ktp', null, ['placeholder' => 'Kota/Kabupaten', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Kecamatan:</strong>
                                {!! Form::text('kecamatan_ktp', null, ['placeholder' => 'Kecamatan', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Kelurahan:</strong>
                                {!! Form::text('kelurahan_ktp', null, ['placeholder' => 'Kelurahan', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Kode Pos:</strong>
                                {!! Form::text('kode_pos_ktp', null, ['placeholder' => 'Kode Pos', 'class' => 'form-control']) !!}
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
                                {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
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

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('.data-table').DataTable({
                responsive: true,
                serverSide: true,
                bDestroy: true,
                processing: true,
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },

                serverSide: true,
                ajax: "{{ route('users.index') }}",

                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'

                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'divisi',
                    name: 'divisi'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                ]
            });


            $('body').on('click', '.delete', function () {
                var userId = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('users.destroy', ':id') }}".replace(':id',
                                userId),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Dihapus!',
                                    response.message || "Data berhasil dihapus.",
                                    'success'
                                );
                                table.ajax.reload();
                            },
                            error: function (xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    xhr.responseJSON.message ||
                                    "Terjadi kesalahan saat menghapus data.",
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection