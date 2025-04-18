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
                            Edit Data Shift Kerja
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #1F573A;">
                        <h3 class="card-title">Form Edit Shift Kerja</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('shift.update', ['shift' => $shift->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nama Shift</label>
                                        <input type="text" class="form-control" name="nama_shift"
                                            placeholder="Nama Shift" required value="{{ $shift->nama_shift }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Tanggal Shift</label>
                                        <input type="date" class="form-control" name="tanggal" required
                                            value="{{ $shift->tanggal }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Jam Masuk</label>
                                        <input type="time" class="form-control" name="jam_masuk" required
                                            value="{{ $shift->jam_masuk }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Jam Pulang</label>
                                        <input type="time" class="form-control" name="jam_keluar" required
                                            value="{{ $shift->jam_keluar }}">
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">Daftar Karyawan</h3>
                                    <button type="button" class="btn btn-success" id="addRow">
                                        <i class="fas fa-plus"></i> Tambah Baris
                                    </button>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table" width="100%" id="karyawanTable">
                                            <thead>
                                                <tr>
                                                    <th width="80%">Nama Karyawan</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($shift->karyawan as $index => $kar)
                                                    <tr>
                                                        <td>
                                                            <select class="form-select select-users" name="id_user[]"
                                                                id="select-users-{{ $index }}">
                                                                @foreach ($karyawan as $k)
                                                                    <option value="{{ $k->id }}"
                                                                        {{ $k->id == $kar->id ? 'selected' : '' }}>
                                                                        {{ $k->name }} -
                                                                        {{ $k->jabatan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-md delete-row">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('shift.index') }}" class="btn btn-danger">Batal</a>
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
        $(document).ready(function() {
            // Initialize TomSelect for the first row
            initializeTomSelect(0);

            // Handle add row button
            $('#addRow').click(function() {
                var rowCount = $('#karyawanTable tbody tr').length;
                var newRow = `
            <tr>
                <td>
                    <select class="form-select select-users" name="id_user[]" id="select-users-${rowCount}">
                        @foreach ($karyawan as $kar)
                            <option value="{{ $kar->id }}">{{ $kar->name }} - {{ $kar->jabatan }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-md delete-row">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
                $('#karyawanTable tbody').append(newRow);

                // Initialize TomSelect for new row
                initializeTomSelect(rowCount);
            });

            // Handle delete row
            $(document).on('click', '.delete-row', function() {
                // Don't remove if it's the only row
                if ($('#karyawanTable tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                }
            });

            // Function to initialize TomSelect
            function initializeTomSelect(index) {
                const selectElement = document.getElementById('select-users-' + index);
                if (selectElement && !selectElement.tomselect) {
                    new TomSelect(selectElement, {
                        copyClassesToDropdown: false,
                        dropdownParent: 'body',
                        controlInput: '<input>',
                        render: {
                            item: function(data, escape) {
                                if (data.customProperties) {
                                    return '<div><span class="dropdown-item-indicator">' + data
                                        .customProperties +
                                        '</span>' + escape(data.text) + '</div>';
                                }
                                return '<div>' + escape(data.text) + '</div>';
                            },
                            option: function(data, escape) {
                                if (data.customProperties) {
                                    return '<div><span class="dropdown-item-indicator">' + data
                                        .customProperties +
                                        '</span>' + escape(data.text) + '</div>';
                                }
                                return '<div>' + escape(data.text) + '</div>';
                            },
                        },
                    });
                }
            }
        });
    </script>
@endpush
