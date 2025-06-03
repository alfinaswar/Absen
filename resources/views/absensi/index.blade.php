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
                            Absensi
                        </div>
                        <h2 class="page-title">
                            Kelola Data Absen
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

                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header style=" font-weight: bold;">
                                <h3 class=" card-title">Download Laporan Absensi</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('absen.download') }}" method="GET" class="row g-3">
                                    @csrf
                                    <div class="col-md-3">
                                        <label for="start_date" class="form-label fw-bold">Tanggal Mulai</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="end_date" class="form-label fw-bold">Tanggal Selesai</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="perusahaan" class="form-label fw-bold">Perusahaan</label>
                                        <select name="perusahaan" id="perusahaan" class="form-select">
                                            <option value="">Semua Perusahaan</option>
                                            @foreach ($company as $pt)
                                                <option value="{{ $pt->id }}">{{ $pt->Nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="karyawan" class="form-label fw-bold">Karyawan</label>
                                        <select name="karyawan" id="karyawan" class="form-select">
                                            <option value="">Semua Karyawan</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="shift" class="form-label fw-bold">Shift</label>
                                        <select name="shift" id="shift" class="form-select">
                                            <option value="">Semua Shift</option>
                                            @foreach ($shifts as $shift)
                                                <option value="{{ $shift->id }}">{{ $shift->nama_shift }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="report_type" class="form-label fw-bold">Jenis Laporan</label>
                                        <select name="jenis_laporan" id="jenis_laporan" class="form-select" required>
                                            <option>--Pilih Salah Satu--</option>
                                            <option value="excel">Excel</option>
                                            <option value="pdf">PDF</option>
                                        </select>
                                    </div>
                                    <div class="text-end">
                                        <button type="button" id="filter-apply" class="btn btn-warning">
                                            <i class="fas fa-filter"></i> Terapkan Filter
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-file-download"></i> Download Laporan
                                        </button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-white" style="background-color: #1F573A;">
                        <h3 class="card-title">Daftar Absensi </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="table-default" class="table-responsive">
                                <table class="table data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Tanggal</th>
                                            <th>Kehadiran</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Status Masuk</th>

                                            <th>Foto Masuk</th>
                                            <th>Foto Keluar</th>

                                            <th>Aksi</th>
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

        <!-- Modal Preview Foto dan Lokasi -->
        <div class="modal fade" id="modalPreviewFoto" tabindex="-1" aria-labelledby="modalPreviewLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPreviewLabel">Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="previewFoto" src="" class="img-fluid mb-3" alt="Foto Preview" height="300px"
                            width="300px">
                        <p id="previewLokasi" class="text-muted"></p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var el;
                window.TomSelect && (new TomSelect(document.getElementById('karyawan'), {
                    copyClassesToDropdown: false,
                    dropdownParent: 'body',
                    controlInput: '<input>',
                    render: {
                        item: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data
                                    .customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                        option: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data
                                    .customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                    },
                }));
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var el;
                window.TomSelect && (new TomSelect(document.getElementById('perusahaan'), {
                    copyClassesToDropdown: false,
                    dropdownParent: 'body',
                    controlInput: '<input>',
                    render: {
                        item: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data
                                    .customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                        option: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data
                                    .customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                    },
                }));
            });
        </script>
        <script type="text/javascript">
            $(document).on('click', '.preview-foto', function() {
                var fotoUrl = $(this).data('foto'); // base64 langsung
                var lokasi = $(this).data('lokasi');
                var title = $(this).data('title');

                $('#modalPreviewLabel').text(title);
                $('#previewFoto').attr('src', fotoUrl);
                $('#previewLokasi').text('Lokasi: ' + lokasi);

                $('#modalPreviewFoto').modal('show');
            });

            $(document).ready(function() {

                var dataTable = function() {
                    var table = $('.data-table');
                    table.DataTable({
                        responsive: true,
                        serverSide: true,
                        bDestroy: true,
                        processing: true,
                        language: {
                            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Memuat...</span> ',
                            paginate: {
                                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                            }
                        },
                        ajax: {
                            url: "{{ route('absen.index') }}",
                            data: function(d) {
                                d.start_date = $('#start_date').val();
                                d.end_date = $('#end_date').val();
                                d.shift = $('#shift').val();
                                d.perusahaan = $('#perusahaan').val();
                                d.karyawan = $('#karyawan').val();
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'nama_karyawan',
                                name: 'nama_karyawan'
                            },
                            {
                                data: 'tanggal',
                                name: 'tanggal'
                            },
                            {
                                data: 'kehadiran',
                                name: 'kehadiran'
                            },
                            {
                                data: 'jam_masuk',
                                name: 'jam_masuk'
                            },
                            {
                                data: 'jam_keluar',
                                name: 'jam_keluar'
                            },
                            {
                                data: 'status_masuk',
                                name: 'status_masuk',
                                orderable: false,
                                searchable: false
                            },

                            {
                                data: 'foto_masuk',
                                name: 'foto_masuk',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'foto_keluar',
                                name: 'foto_keluar',
                                orderable: false,
                                searchable: false
                            },

                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ],
                    });
                };

                dataTable();
                $('#filter-apply').click(function() {
                    $('.data-table').DataTable().ajax.reload();
                });
                $('body').on('click', '.acc-cuti', function() {
                    var id = $(this).data('id'); // Ambil ID data

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "ACC cuti tidak dapat dibatalkan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, ACC Cuti!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('absen.accCuti') }}",
                                type: "POST",
                                data: {
                                    id: id,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    Swal.fire(
                                        'Berhasil!',
                                        response.message || 'Cuti berhasil di-ACC.',
                                        'success'
                                    );
                                    table.ajax.reload(); // Refresh DataTable
                                },
                                error: function(xhr) {
                                    Swal.fire(
                                        'Gagal!',
                                        xhr.responseJSON.message ||
                                        'Terjadi kesalahan saat meng-ACC cuti.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });
                $(document).on('click', '.delete', function() {
                    var id = $(this).data('id');
                    var url = '{{ route('absen.destroy', ':id') }}'.replace(':id', id);

                    Swal.fire({
                        title: 'Anda yakin ingin menghapus data ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire(
                                            'Dihapus!',
                                            'Data berhasil dihapus.',
                                            'success'
                                        ).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire(
                                            'Gagal!',
                                            'Data gagal dihapus.',
                                            'error'
                                        );
                                    }
                                },
                                error: function() {
                                    Swal.fire(
                                        'Error!',
                                        'Terjadi kesalahan saat menghapus data.',
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
