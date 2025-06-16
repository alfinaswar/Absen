@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            height: 400px;
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')
            <div class="page-wrapper mb-3">
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <div class="page-pretitle">Edit Data</div>
                                <h2 class="page-title">Master Perusahaan</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="container-xl">
                        <div class="card">
                            <div class="card-header text-white" style="background-color: #1F573A;">
                                <h3 class="card-title">Form Edit Master Perusahaan</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('mp.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control" id="nama_perusahaan" name="Nama"
                                                    placeholder="Masukkan Nama Perusahaan" value="{{ $data->Nama }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="Alamat" rows="3"
                                                    placeholder="Masukkan Alamat" required>{{ $data->Alamat }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="Email"
                                                    placeholder="Masukkan Email" value="{{ $data->Email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telepon" class="form-label">Telepon / Wa</label>
                                                <input type="text" class="form-control" id="telepon" name="Telepon"
                                                    placeholder="Masukkan Telepon / Wa" value="{{ $data->Telepon }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="provinsi" class="form-label">Provinsi</label>
                                                <select class="form-control" name="Provinsi" id="provinsi" required>
                                                    <option value="{{ $data->Provinsi }}" selected>{{ $data->Provinsi }}</option>
                                                    @php
    $provinces = new App\Http\Controllers\DependantDropdownController;
    $provinces = $provinces->provinces();
                                                    @endphp
                                                    @foreach ($provinces as $item)
                                                        <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kota" class="form-label">Kabupaten / Kota</label>
                                                <select class="form-control" name="Kota" id="kota" required>
                                                    <option value="{{ $data->Kota }}" selected>{{ $data->Kota }}</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kode_pos" class="form-label">Kode Pos</label>
                                                <input type="text" class="form-control" id="kode_pos" name="KodePos"
                                                    placeholder="Masukkan Kode Pos" value="{{ $data->KodePos }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="direktur" class="form-label">HR / Perwakilan</label>
                                                <input type="text" class="form-control" id="direktur" name="Direktur"
                                                    placeholder="Masukkan HR / Perwakilan" value="{{ $data->Direktur }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="latitude" class="form-label">Latitude</label>
                                                <input type="text" class="form-control" id="latitude" name="Latitude"
                                                    placeholder="Masukkan Latitude" value="{{ $data->Latitude }}" readonly required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="longitude" class="form-label">Longitude</label>
                                                <input type="text" class="form-control" id="longitude" name="Longitude"
                                                    placeholder="Masukkan Longitude" value="{{ $data->Longitude }}" readonly
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_tutup_buku" class="form-label">Tanggal Tutup Buku</label>
                                                <input type="date" class="form-control" id="tanggal_tutup_buku" name="TanggalTutupBuku"
                                                    placeholder="Masukkan Tanggal Tutup Buku" value="{{ $data->TanggalTutupBuku }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div id="map"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@push('js')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        function onChangeSelect(url, id, name) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>==Pilih Salah Satu==</option>');

                    $.each(data, function (key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
        $(function () {
            $('#provinsi').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
            });
            $('#kota').on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
            })
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var defaultLat = {{ $data->Latitude ?? '-6.21462' }};
            var defaultLng = {{ $data->Longitude ?? '106.84513' }};
            var map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 18,
            }).addTo(map);

            var marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);
            document.getElementById('latitude').value = defaultLat;
            document.getElementById('longitude').value = defaultLng;
            marker.on('dragend', function (e) {
                var latlng = marker.getLatLng();
                document.getElementById('latitude').value = latlng.lat;
                document.getElementById('longitude').value = latlng.lng;
            });
            map.on('click', function (e) {
                marker.setLatLng(e.latlng);
                document.getElementById('latitude').value = e.latlng.lat;
                document.getElementById('longitude').value = e.latlng.lng;
            });
            L.Control.geocoder({
                defaultMarkGeocode: false
            })
                .on('markgeocode', function (e) {
                    var center = e.geocode.center;
                    marker.setLatLng(center);
                    map.setView(center, 16);
                    document.getElementById('latitude').value = center.lat;
                    document.getElementById('longitude').value = center.lng;
                })
                .addTo(map);
        });
    </script>
@endpush