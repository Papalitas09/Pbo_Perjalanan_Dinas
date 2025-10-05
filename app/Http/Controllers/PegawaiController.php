<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pegawai;
use Illuminate\Support\Facades\Hash;
use App\Models\CatatanDinas;
use Illuminate\Support\Facades\Auth;
class PegawaiController extends Controller
{
    //ADMIN PEGAWAI MANAGE LOGIC
    public function index()
    {
        $pegawai = pegawai::all();
        return view('Admin.pegawai.index', compact('pegawai'));
    }

    //export pegawai
    public function count()
    {
        $total = CatatanDinas::count();

        return response()->json([
            'labels' => ['Riwayat Catatan'],
            'values' => [$total],
        ]);
    }

    public function create()
    {
        return view('Admin.pegawai.create');
    }

    public function edit(String $id)
    {
        $pegawai = pegawai::find($id);
        return view('Admin.pegawai.edit', compact('pegawai'));
    }
//form tambah pegawai (admin)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email',
            'no_induk' => 'required|unique:pegawai,no_induk',
            'no_telepon' => 'required|string|max:100',
            'password' => 'required|string|max:100',
        ]);

        Pegawai::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_induk' => $request->no_induk,
            'no_telepon' => $request->no_telepon,
            'password' => bcrypt($request->password), // default password
            'role' => 'pegawai'
        ]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_induk' => 'required|unique:pegawai,no_induk,' . $id, // tambahkan pengecualian untuk ID saat ini
            'no_telepon' => 'required|string|max:100',
            'password' => 'nullable|string|max:100',
        ]);

        $pegawai->fill($request->except('password'));

        if ($request->filled('password')) {
            $pegawai->password = bcrypt($request->password);
        }

        $pegawai->save();

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');

    }

    public function destroy(String $id)
    {
        $pegawai = Pegawai::findOrFail($id);

    // Hapus data
        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')->with('success', 'Data berhasil dihapus!');
    }

    // Pegawai
    public function show()
    {
        $pegawai = Auth::guard('pegawai')->user();
        $riwayat = CatatanDinas::where('no_induk', $pegawai->no_induk)->count();

        $data = CatatanDinas::where('no_induk', $pegawai->no_induk)->where('status_tampil', 'Tertunda')->get();
        return view('pegawai.dashboard', compact('data', 'riwayat'));
    }
}
