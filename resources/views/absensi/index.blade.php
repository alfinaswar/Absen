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
                @can('data-laporan')
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <form action="{{ route('absen.download') }}" method="GET" class="row g-3">
                                @csrf
                                <div class="col-md-5">
                                    <label for="start_date" class="form-label fw-bold">Tanggal Mulai</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="end_date" class="form-label fw-bold">Tanggal Selesai</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                                </div>
                                <div class="col-md-2 align-self-end">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-download"></i> Download Laporan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endcan
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
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Ontime</th>

                                            <th>Status</th>
                                            <th>Approval</th>
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
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('.data-table').DataTable({
                    responsive: true,
                    serverSide: true,
                    processing: true,
                    ajax: "{{ route('absen.index') }}",

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'user.name',
                            name: 'user.name'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
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
                            data: 'ontime',
                            name: 'ontime'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'Approval',
                            name: 'Approval'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
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
