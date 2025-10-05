@extends('layouts.app')

@section('content')
<div class="p-6 bg-white border border-gray-300 w-full max-h-[800px] shadow-xl rounded-xl">
    <h1 class="text-2xl font-bold mb-6">Edit Catatan Dinas</h1>

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('admin.catatan.update', $catatan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Lokasi -->
     <div>
            <label for="pegawai_id" class="block text-gray-700 font-semibold mb-2">
                Pegawai yang Dinas
            </label>
           <select name="no_induk" class="w-full border rounded-lg px-3 py-2">
                <option value="">-- Pilih Pegawai --</option>
                @foreach($datapegawai as $pegawai)
                    <option value="{{ $pegawai->no_induk }}"
                        {{ old('no_induk', $catatan->no_induk ?? '') == $pegawai->no_induk ? 'selected' : '' }}>
                        {{ $pegawai->nama }} ({{ $pegawai->no_induk }})
                    </option>
                @endforeach
            </select>

        </div>

        {{-- Lokasi --}}
        <div>
            <label for="lokasi" class="block text-gray-700 font-semibold mb-2">Lokasi Tujuan</label>
            <input type="text" name="lokasi" id="lokasi"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
                placeholder="Contoh: Jakarta, Bandung, atau Surabaya" required value="{{ $catatan->lokasi }}">
        </div>

        {{-- Tanggal Berangkat & Pulang --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="tanggal_berangkat" class="block text-gray-700 font-semibold mb-2">
                    Tanggal Berangkat
                </label>
                <input type="date" name="tanggal_berangkat" id="tanggal_berangkat"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
                    required value="{{ $catatan->tanggal_berangkat }}">
            </div>
            <div>
                <label for="tanggal_pulang" class="block text-gray-700 font-semibold mb-2">
                    Tanggal Pulang
                </label>
                <input type="date" name="tanggal_pulang" id="tanggal_pulang"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
                    required value="{{ $catatan->tanggal_pulang }}">
            </div>
        </div>

      {{-- Catatan Lainnya --}}
<div>
    <label for="catatan_lainnya" class="block text-gray-700 font-semibold mb-2">Catatan Lainnya</label>
    <textarea name="catatan_lainnya" id="catatan_lainnya" rows="3"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500"
        placeholder="Masukkan catatan tambahan (opsional)...">{{ old('catatan_lainnya', $catatan->catatan_lainnya ?? '') }}</textarea>
</div>

{{-- Status --}}
<div>
    <label for="status" class="block text-gray-700 font-semibold mb-2">Status</label>
    <select name="status" id="status"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500">
        @foreach (['Belum Berlangsung', 'Berlangsung', 'Selesai'] as $status)
            <option value="{{ $status }}"
                {{ old('status', $catatan->status ?? '') == $status ? 'selected' : '' }}>
                {{ $status }}
            </option>
        @endforeach
    </select>
</div>

{{-- Status Tampil --}}
<div>
    <label for="status_tampil" class="block text-gray-700 font-semibold mb-2">Status Tampil</label>
    <select name="status_tampil" id="status_tampil"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500">
        @foreach (['Tertunda', 'Disetujui', 'Ditolak'] as $status_tampil)
            <option value="{{ $status_tampil }}"
                {{ old('status_tampil', $catatan->status_tampil ?? '') == $status_tampil ? 'selected' : '' }}>
                {{ $status_tampil }}
            </option>
        @endforeach
    </select>
</div>


        {{-- Tombol Aksi --}}
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="{{ route('admin.catatan.index') }}"
                class="text-emerald-600 hover:underline font-semibold flex items-center gap-1">
                ← Kembali
            </a>
            <button type="submit"
                class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-8 py-2 rounded-lg shadow-md transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
