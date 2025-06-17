@foreach ($data as $d)
    <div class="table-row">
        <div>{{ $d->tanggal }}</div>
        <div>{{ $d->jam_masuk }}</div>
        <div>{{ $d->jam_keluar }}</div>
    </div>
@endforeach
{{-- <div id="attendance-table">
    <div class="loading">
        <i class="fas fa-calendar-alt"></i><br><br>
        Pilih bulan untuk melihat data absensi
    </div>
</div>
@endforelse --}}