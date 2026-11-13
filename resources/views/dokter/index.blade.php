@extends('layout')
@section('judul', 'Data Dokter')

@section('konten')
<div class="header">
    <div>
        <h1>Data Dokter</h1>
        <span class="sub">{{ $data->count() }} dokter terdaftar</span>
    </div>

    @if (auth()->user()->isAdmin())
    <div class="aksi-atas">
        <form action="{{ route('dokter.reset') }}" method="POST"
              onsubmit="return confirm('Yakin hapus SEMUA data dokter?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn ghost-merah">Reset Data</button>
        </form>
        <a href="{{ route('dokter.create') }}" class="btn biru">+ Tambah Dokter</a>
    </div>
    @endif
</div>

@if (session('pesan'))
    <div class="alert success">{{ session('pesan') }}</div>
@endif

@if (session('error'))
    <div class="alert error">{{ session('error') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>No</th><th>Kode</th><th>Nama</th><th>Spesialisasi</th>
            <th>Hari Praktik</th><th>Telepon</th><th class="kanan">Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($data as $i => $r)
        <tr>
            <td class="muted">{{ $i + 1 }}</td>
            <td><span class="kode">{{ $r->kode_dokter }}</span></td>
            <td>
                <strong>{{ $r->nama_lengkap }}</strong>
                @if ($r->gelar)<div class="muted">{{ $r->gelar }}</div>@endif
            </td>
            <td>{{ $r->spesialisasi }}</td>
            <td>
                @if ($r->hari_praktik)
                    @foreach (explode(',', $r->hari_praktik) as $hari)
                        <span class="badge">{{ $hari }}</span>
                    @endforeach
                @else
                    <span class="muted">-</span>
                @endif
            </td>
            <td>{{ $r->telepon }}</td>
            <td class="kanan nowrap">
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('dokter.edit', $r) }}" class="link">Edit</a>
                    <form action="{{ route('dokter.destroy', $r) }}" method="POST" class="inline"
                          onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="link merah">Hapus</button>
                    </form>
                @else
                    <span class="muted">Hanya lihat</span>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="kosong">Belum ada data dokter.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection