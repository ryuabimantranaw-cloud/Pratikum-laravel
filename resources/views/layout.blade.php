<!DOCTYPE html>
<html>
<head>
    <title>@yield('judul', 'Klinik Sehat')</title>
    <link rel="stylesheet" href="{{ asset('css/tampilan.css') }}">
</head>
<body>

<div class="navbar">
    <div class="logo">Klinik Sehat</div>
    <div class="nav-links">
        @auth
            <a href="#">Home</a>
            <a href="{{ route('dokter.index') }}" class="active">Data Dokter</a>
            <a href="#">Data Pasien</a>
            <a href="#">Jadwal Praktik</a>
            <span class="user-info">
                {{ auth()->user()->name }} <span class="badge">{{ auth()->user()->role }}</span>
            </span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="link merah">Logout</button>
            </form>
        @endauth
    </div>
</div>

<div class="container">
    @yield('konten')
</div>

</body>
</html>