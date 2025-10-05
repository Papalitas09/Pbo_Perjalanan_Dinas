@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-xl border border-gray-300 border-collapse h-full py-5">
    <h1 class="text-4xl font-bold mb-6 mt-4">Selamat datang   <span class="text-emerald-400 font-extrabold">{{ Auth::guard('pegawai')->user()->nama }}</span> !</h1>

    <!-- Card Utama -->
    <div class="bg-gray-2 rounded-lg shadow-md mb-16 flex">
        <!-- Tambahkan scroll horizontal & vertical -->
        <div class="overflow-x-auto overflow-y-auto max-h-96 ">
            <table class="min-w-full border-collapse border  border-gray-200 ">
                <thead>
                    <tr class="bg-emerald-400 text-white">
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Lokasi</th>
                        <th class="border px-4 py-2">Tanggal Berangkat</th>
                        <th class="border px-4 py-2">Tanggal Pulang</th>
                        <th class="border px-4 py-2">No Induk</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Catatan Lainnya</th>
                        <th class="border px-4 py-2">Status Tampil</th>
                        <th class="border px-4 py-2">Aksi</th>
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
                        <td class="border px-4 py-2">
                            @if($item->status_tampil == 'Tertunda')
                                <span class="text-yellow-600 font-semibold">{{ $item->status_tampil }}</span>
                            @elseif($item->status_tampil == 'Disetujui')
                                <span class="text-green-600 font-semibold">{{ $item->status_tampil }}</span>
                            @else
                                <span class="text-red-600 font-semibold">{{ $item->status_tampil }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center">
                            <form action="{{ route('admin.catatan.approved', $item->id) }}" method="POST" class="mb-2">
                                @csrf @method('PUT')
                                <button class="bg-green-500 text-white w-full px-4 py-1 rounded">Setujui</button>
                            </form>
                            <form action="{{ route('admin.catatan.rejected', $item->id) }}" method="POST">
                                @csrf @method('PUT')
                                <button class="bg-red-500 text-white w-full px-8 py-1 rounded">Tolak</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center border px-4 py-2">
                            <span class="text-gray-400">Belum ada data ditampilkan</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



    <!-- Grid Bawah -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Jumlah Pegawai -->
        <div class="bg-emerald-400 rounded-lg shadow-md p-4">
            <h3 class="text-center text-white font-semibold mb-4 text-2xl">
                Jumlah Pegawai
            </h3>
            <div class="bg-white rounded-lg h-48 flex items-center justify-center flex-col gap-5">
                <h3 class="text-5xl font-bold text-emerald-400 ">{{ $jumlahpegawai + 1 }}</h3>
            </div>
        </div>

        <div class="bg-emerald-400 rounded-lg shadow-md p-4">
            <h3 class="text-center text-white font-semibold mb-4 text-2xl">
                Jumlah Catatan Perjalanan
            </h3>
            <div class="bg-white rounded-lg h-48 flex items-center justify-center flex-col gap-5">
                <h3 class="text-5xl font-bold text-emerald-400 ">{{ $jumlahcatatan + 1}}</h3>
            </div>
        </div>

        <!-- Export Data -->
        {{-- <div class="bg-emerald-400 rounded-lg shadow-md p-4 flex flex-col items-center justify-center">
            <h3 class="text-center text-white font-semibold mb-4">
                Export data perjalanan pegawai
            </h3>
            <a href="{{ url('/export/RCT') }}"
                class="bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg">
                EKSPOR
            </a>
        </div> --}}
    </div>
</div>
@endsection