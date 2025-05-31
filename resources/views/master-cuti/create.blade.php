@extends('layouts.app')

@section('content')
    <div class="page-wrapper mb-3">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Master
                        </div>
                        <h2 class="page-title">
                            Tambah Jenis Cuti
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #1F573A;">
                        <h3 class="card-title">Form Tambah Jenis Cuti</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cuti.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="kode" name="Kode" placeholder="Kode" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama / Jenis Time Off </label>
                                <input type="text" class="form-control" id="nama" name="Nama" placeholder="Nama" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection