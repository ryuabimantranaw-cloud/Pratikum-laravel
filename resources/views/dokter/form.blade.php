@extends('layout')
@section('judul', $dokter ? 'Edit Data Dokter' : 'Form Data Dokter')

@php
    $hariDipilih = old('hari_praktik', $dokter && $dokter->hari_praktik ? explode(',', $dokter->hari_praktik) : []);
    $jk = old('jenis_kelamin', $dokter->jenis_kelamin ?? '');
    $sp = old('spesialisasi', $dokter->spesialisasi ?? '');
@endphp

@section('konten')
<h1>{{ $dokter ? 'Edit' : 'Form' }} Data Dokter</h1>
<p>Isi data master dokter, nomor SIP (Surat Izin Praktik), spesialisasi, dan kontak.</p>

@if ($errors->any())
    <div class="alert error">
        @foreach ($errors->all() as $e) <div>{{ $e }}</div> @endforeach
    </div>
@endif

<form action="{{ $dokter ? route('dokter.update', $dokter) : route('dokter.store') }}" method="POST">
    @csrf
    @if ($dokter) @method('PUT') @endif

    <h3>1. Identitas Dokter</h3>

    <p>Kode Dokter *<br>
        <input type="text" name="kode_dokter" placeholder="Dr.001"
               value="{{ old('kode_dokter', $dokter->kode_dokter ?? '') }}" required></p>

    <p>Nama Lengkap *<br>
        <input type="text" name="nama_lengkap" placeholder="Nama tanpa gelar"
               value="{{ old('nama_lengkap', $dokter->nama_lengkap ?? '') }}" required></p>

    <p>Gelar<br>
        <input type="text" name="gelar" placeholder="Gelar"
               value="{{ old('gelar', $dokter->gelar ?? '') }}"></p>

    <p>Jenis Kelamin *<br>
        <input type="radio" id="jk_l" name="jenis_kelamin" value="Laki-laki" {{ $jk === 'Laki-laki' ? 'checked' : '' }} required>
        <label for="jk_l">Laki-laki</label>
        <input type="radio" id="jk_p" name="jenis_kelamin" value="Perempuan" {{ $jk === 'Perempuan' ? 'checked' : '' }}>
        <label for="jk_p">Perempuan</label>
    </p>

    <h3>2. Izin Praktik &amp; Spesialisasi</h3>

    <p>No. SIP *<br>
        <input type="text" name="sip" placeholder="No. SIP"
               value="{{ old('sip', $dokter->sip ?? '') }}" required></p>

    <p>Spesialisasi *<br>
        <select name="spesialisasi" required>
            <option value="">-- Pilih Spesialisasi --</option>
            @foreach ($daftarSpesialisasi as $s)
                <option value="{{ $s }}" {{ $sp === $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
    </p>

    <p>Hari Praktik<br>
        @foreach ($daftarHari as $hari)
            <input type="checkbox" name="hari_praktik[]" value="{{ $hari }}"
                   {{ in_array($hari, $hariDipilih) ? 'checked' : '' }}> {{ $hari }}
        @endforeach
    </p>

    <h3>3. Kontak</h3>

    <p>Email<br>
        <input type="email" name="email" placeholder="name@gmail.com"
               value="{{ old('email', $dokter->email ?? '') }}"></p>

    <p>No. Telepon / HP *<br>
        <input type="text" name="telepon" placeholder="No. Telepon"
               value="{{ old('telepon', $dokter->telepon ?? '') }}" required></p>

    <p>
        <a href="{{ route('dokter.index') }}" class="btn ghost-abu">Kembali</a>
        <button type="submit" class="btn-simpan">Simpan Dokter</button>
    </p>
</form>
@endsection