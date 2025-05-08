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
                        <h3 class="card-title">Form Tambah Master Status Pegawai</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master-status-pegawai.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="nama_perusahaan" class="form-label">Status Kepegawaian</label>
                                        <input type="text" class="form-control" id="nama_perusahaan" name="nama"
                                            placeholder="Masukkan Status Pegawai" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection