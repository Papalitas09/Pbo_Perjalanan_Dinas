@extends('layouts.app')

@section('content')
<div class="p-6 bg-white border border-gray-300 w-full max-h-[600px] shadow-2xl rounded-xl">
    <h1 class="text-2xl font-bold mb-6">Edit Pegawai</h1>

    <form action="{{ route('admin.pegawai.update', $pegawai->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div>
    <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Pegawai</label>
    <input type="text" name="nama" id="nama"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
        placeholder="Contoh: Ilham Sipahutar" required value="{{ $pegawai->nama }}">
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
                    placeholder="Password pegawai" value="{{ $pegawai->password }}">
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
                    placeholder="email@example.com" required value="{{ $pegawai->email }}">
            </div>

            <div>
                <label for="no_induk" class="block text-gray-700 font-semibold mb-2">Nomor Induk</label>
                <input type="text" name="no_induk" id="no_induk"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
                    placeholder="Contoh: 2100038392" required value="{{ $pegawai->no_induk }}">
            </div>

            <div>
                <label for="no_telepon" class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
                    placeholder="Contoh: 08571952772" required value="{{ $pegawai->no_telepon }}">
            </div>
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('admin.pegawai.index') }}" class="text-emerald-600 hover:underline">← Back</a>
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg">
                SUBMIT
            </button>
        </div>
    </form>
</div>
@endsection
