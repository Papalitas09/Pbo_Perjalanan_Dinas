<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Laravel')</title>
    @vite('resources/css/app.css')
</head>
<body class="flex">
    {{-- Navbar --}}
    @if(Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->role === 'admin')
        @include('components.sidebar')
    @else
        @include('components.sidebarpegawai')
    @endif

    {{-- Content --}}
    <main class="container m-9">
        @yield('content')
    </main>
</body>
</html>
