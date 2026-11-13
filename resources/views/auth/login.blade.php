@extends('layout')
@section('judul', 'Login')

@section('konten')
<div class="login-box">
    <h1>Login</h1>
    <p>Masuk untuk mengakses sistem informasi klinik.</p>

    @if (session('pesan'))
        <div class="alert success">{{ session('pesan') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.proses') }}" method="POST">
        @csrf
        <p>Email<br>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@klinik.test" required autofocus></p>
        <p>Password<br>
            <input type="password" name="password" placeholder="password" required></p>
        <button type="submit" class="btn-simpan full">Login</button>
    </form>

    <p class="muted demo">
        Akun admin: admin@klinik.test / password<br>
        Akun staf: staf@klinik.test / password
    </p>
</div>
@endsection