@extends('layouts.app')

@section('title', 'Halaman Utama')

@section('content')
   <div class="bg-emerald-400 rounded-lg shadow-md p-4 mb-6">
        <h2 class="text-center text-white font-semibold mb-4">
            Request
        </h2>
        <div class="bg-white rounded-lg h-64 flex items-start justify-center">
             <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Lokasi</th>
                        <th class="border px-4 py-2">Tanggal Berangkat</th>
                        <th class="border px-4 py-2">Tanggal Pulang</th>
                        <th class="border px-4 py-2">No Induk</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Catatan Lainnya</th>
                        <th class="border px-4 py-2">Display Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $index + 1}}</td>
                            <td class="border px-4 py-2">{{ $item->lokasi }}</td>
                            <td class="border px-4 py-2">{{ $item->tanggal_berangkat }}</td>
                            <td class="border px-4 py-2">{{ $item->tanggal_pulang }}</td>
                            <td class="border px-4 py-2">{{ $item->no_induk }}</td>
                            <td class="border px-4 py-2">
                                @if($item->status == 'Belum Berlangsung')
                                    <span class="text-yellow-600 font-semibold">{{ $item->status }}</span>
                                @elseif($item->status == 'Berlangsung')
                                    <span class="text-blue-600 font-semibold">{{ $item->status }}</span>
                                @else
                                    <span class="text-green-600 font-semibold">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $item->catatan_lainnya }}</td>
                            <td class="border px-4 py-2">{{ $item->status_tampil }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center border px-4 py-2"><span class="text-gray-400">Belum ada data ditampilkan</span></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
          
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Jumlah Pegawai -->
        <div class="bg-emerald-400 rounded-lg shadow-md p-4">
            <h3 class="text-center text-white font-semibold mb-4">
                Riwayat Perjalanan
            </h3>
            <div class="bg-white rounded-lg h-48 flex items-center justify-center">
                <h2 class="text-black">1</h2>
            </div>
        </div>
@endsection
