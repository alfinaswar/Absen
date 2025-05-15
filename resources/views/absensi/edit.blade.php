@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3>Edit Absensi</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('absen.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="user_id" class="form-label fw-bold">Nama</label>
                                <input type="text" id="user_id" class="form-control" value="{{ $data->user->name ?? '-' }}"
                                    disabled>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                    value="{{ $data->tanggal }}" required>
                            </div>

                            <!-- Jam Masuk -->
                            <div class="mb-3">
                                <label for="jam_masuk" class="form-label fw-bold">Jam Masuk</label>
                                <input type="time" name="jam_masuk" id="jam_masuk" class="form-control"
                                    value="{{ $data->jam_masuk }}" required>
                            </div>

                            <!-- Jam Keluar -->
                            <div class="mb-3">
                                <label for="jam_keluar" class="form-label fw-bold">Jam Keluar</label>
                                <input type="time" name="jam_keluar" id="jam_keluar" class="form-control"
                                    value="{{ $data->jam_keluar }}">
                            </div>



                            <!-- Ontime -->
                            <div class="mb-3">
                                <label for="ontime" class="form-label fw-bold">Ontime</label>
                                <select name="ontime" id="ontime" class="form-select" required>
                                    <option value="Y" {{ $data->ontime == 'Y' ? 'selected' : '' }}>Ya</option>
                                    <option value="N" {{ $data->ontime == 'N' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                <a href="{{ route('absen.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection