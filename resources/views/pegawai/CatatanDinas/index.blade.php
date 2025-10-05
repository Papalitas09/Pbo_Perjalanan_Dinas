@extends('layouts.app')

@section('title', 'Daftar Catatan Dinas')

@section('content')
<div class="bg-white border border-gray-300 border-collapse w-full shadow-xl rounded-xl p-5">
    <h1 class="text-4xl font-bold mb-6">Daftar Catatan Dinas</h1>

    <!-- Tabel Catatan Dinas -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto overflow-y-auto max-h-[500px]">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-emerald-400 text-white">
                    <th class="px-4 py-2 border">NO</th>
                    <th class="px-4 py-2 border">Lokasi</th>
                    <th class="px-4 py-2 border">Tanggal Berangkat</th>
                    <th class="px-4 py-2 border">Tanggal Pulang</th>
                    <th class="px-4 py-2 border">No Induk</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Status Tampil</th>
                    <th class="px-4 py-2 border">Catatan Lainnya</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $item->lokasi }}</td>
                    <td class="px-4 py-2 border">{{ $item->tanggal_berangkat }}</td>
                    <td class="px-4 py-2 border">{{ $item->tanggal_pulang }}</td>
                    <td class="px-4 py-2 border">{{ $item->no_induk }}</td>
                    <td class="px-4 py-2 border">
                        @if($item->status == 'Belum Berlangsung')
                            <span class="text-yellow-600 font-semibold">{{ $item->status }}</span>
                        @elseif($item->status == 'Berlangsung')
                            <span class="text-blue-600 font-semibold">{{ $item->status }}</span>
                        @else
                            <span class="text-green-600 font-semibold">{{ $item->status }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border">
                        @if($item->status_tampil == 'Tertunda')
                            <span class="text-yellow-600 font-semibold">{{ $item->status_tampil }}</span>
                        @elseif($item->status_tampil == 'Disetujui')
                            <span class="text-green-600 font-semibold">{{ $item->status_tampil }}</span>
                        @else
                            <span class="text-red-600 font-semibold">{{ $item->status_tampil }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $item->catatan_lainnya ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
