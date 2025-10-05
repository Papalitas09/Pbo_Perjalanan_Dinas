@extends('layouts.app')

@section('content')
<div class="p-6 bg-white border border-gray-300 border-collapse w-full shadow-xl rounded-xl">
    <h1 class="text-4xl font-bold mb-6">Daftar Pegawai</h1>

    <!-- Tombol Create -->
    <div class="mb-4">
        <a href="{{ route('admin.pegawai.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-4 rounded-lg">
            <i class="fas fa-user-plus"></i>👤 Create Pegawai
        </a>
    </div>
    
    <!-- Tabel Pegawai -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto overflow-y-auto max-h-[500px] flex flex-col space-y-3">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-emerald-400 text-white">
                    <th class="px-4 py-2 border">NO</th>
                    <th class="px-4 py-2 border">NAMA</th>
                    <th class="px-4 py-2 border">EMAIL</th>
                    <th class="px-4 py-2 border">NIP</th>
                    <th class="px-4 py-2 border">PASSWORD</th>
                    <th class="px-4 py-2 border">NO TELP</th>
                    <th class="px-4 py-2 border">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pegawai as $index => $p)
                <tr id="row-{{ $p->id }}" class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border" id="nama-{{ $p->id }}">{{ $p->nama }}</td>
                    <td class="px-4 py-2 border" id="email-{{ $p->id }}">{{ $p->email }}</td>
                    <td class="px-4 py-2 border">{{ $p->no_induk }}</td>
                    <td class="px-4 py-2 border">********</td>
                    <td class="px-4 py-2 border" id="telp-{{ $p->id }}">{{ $p->no_telepon }}</td>
                    <td class="px-4 py-2 border text-center">
                        <div class="flex flex-col items-center space-y-2 w-full">
                            <a href="{{ route('admin.pegawai.edit', $p->id) }}"
                                class="w-28 bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-center">
                                Edit
                            </a>
                            <form action="{{ route('admin.pegawai.destroy', $p->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus data?')" class="w-28">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data pegawai</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function enableEdit(id) {
        let nama = document.getElementById('nama-' + id).innerText;
        let email = document.getElementById('email-' + id).innerText;
        let telp = document.getElementById('telp-' + id).innerText;

        document.getElementById('nama-' + id).innerHTML = `<input type="text" id="input-nama-${id}" value="${nama}" class="border rounded px-2">`;
        document.getElementById('email-' + id).innerHTML = `<input type="email" id="input-email-${id}" value="${email}" class="border rounded px-2">`;
        document.getElementById('telp-' + id).innerHTML = `<input type="text" id="input-telp-${id}" value="${telp}" class="border rounded px-2">`;

        document.getElementById('edit-' + id).classList.add('hidden');
        document.getElementById('save-' + id).classList.remove('hidden');
        document.getElementById('cancel-' + id).classList.remove('hidden');
    }

    function cancelEdit(id) {
        location.reload(); // langsung reload halaman
    }

    function saveEdit(id) {
        let nama = document.getElementById('input-nama-' + id).value;
        let email = document.getElementById('input-email-' + id).value;
        let telp = document.getElementById('input-telp-' + id).value;

        fetch(`/admin/pegawai/${id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nama,
                    email,
                    no_telepon: telp
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                }
            })
            .catch(err => console.error(err));
    }
</script>
@endsection
