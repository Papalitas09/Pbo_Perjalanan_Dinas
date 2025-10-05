<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatatanDinas;
use Illuminate\Support\Facades\Auth;
use App\Models\pegawai;
class catatanDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CatatanDinas $catatan)
    {
        $pegawai = Auth::guard('pegawai')->user();
        if(Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->role === 'pegawai')
        {
            $data = $catatan::where('no_induk', $pegawai->no_induk)->get();
            return view('pegawai.CatatanDinas.index' ,compact('data'));
        }
        else
        {

            $data = CatatanDinas::whereHas('pegawai', function ($q) {$q->where('role', 'pegawai');})->get();

            return view('Admin.catatan.index' ,compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->role === 'admin'){
            $datapegawai = Pegawai::where('role', 'pegawai')->orderBy('nama')->get();
            return view('Admin.catatan.create', compact('datapegawai'));
        } else {
            return view('pegawai.CatatanDinas.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if(Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->role === 'admin'){
             $request->validate([
                'no_induk' => 'required|exists:pegawai,no_induk',
                'lokasi' => 'required|string|max:255',
                'tanggal_berangkat' => 'required|date',
                'tanggal_pulang' => 'required|date|after_or_equal:tanggal_berangkat',
                'status' => 'nullable',
                'status_tampil' => 'nullable',
                'catatan_lainnya' => 'nullable|string',
            ]);
            

            CatatanDinas::create([
                'no_induk' => $request->no_induk, // ← ini yang dikirim dari select
                'lokasi' => $request->lokasi,
                'tanggal_berangkat' => $request->tanggal_berangkat,
                'tanggal_pulang' => $request->tanggal_pulang,
                'status' => $request->status,
                'status_tampil' => $request->status_tampil,
                'catatan_lainnya' => $request->catatan_lainnya,
            ]);
            
            return redirect()->route('admin.catatan.index')->with('success', 'Perjalanan dinas berhasil dibuat!');
        } 
        else {
            $pegawai = Auth::guard('pegawai')->user();
            // dd($pegawai->role); // Lihat apa yang keluar
            $request->validate([
                'lokasi' => 'required|string|max:255',
                'tanggal_berangkat' => 'required|date',
                'tanggal_pulang' => 'required|date|after_or_equal:tanggal_berangkat',
                'catatan_lainnya' => 'nullable|string',
            ]);

            CatatanDinas::create([
                'no_induk' => $pegawai->no_induk,
                'lokasi' => $request->lokasi,
                'tanggal_berangkat' => $request->tanggal_berangkat,
                'tanggal_pulang' => $request->tanggal_pulang,
                'status' => 'Belum Berlangsung', // ← SET DEFAULT
                'catatan_lainnya' => $request->catatan_lainnya,
                'status_tampil' => 'Tertunda', // ← SET DEFAULT
            ]);
            return redirect()->route('pegawai.catatan.index');
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $catatan = CatatanDinas::findOrFail($id);
        $datapegawai = Pegawai::where('role', 'pegawai')->get();
        // dd($catatan);
        return view("Admin.catatan.edit", compact('catatan',  'datapegawai'));
        
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, String $id)
    {
        $catatan = CatatanDinas::findOrFail($id);
        // dd($request->all());
        $request->validate([
        'no_induk' => 'required|exists:pegawai,no_induk',
        'lokasi' => 'required|string|max:255',
        'tanggal_berangkat' => 'required|date',
        'tanggal_pulang' => 'required|date|after_or_equal:tanggal_berangkat',
        'status' => 'required|in:Belum Berlangsung,Berlangsung,Selesai',
        'status_tampil' => 'required|in:Tertunda,Disetujui,Ditolak',
        'catatan_lainnya' => 'nullable|string',
    ]);

    $catatan->update([
        'no_induk' => $request->no_induk,
        'lokasi' => $request->lokasi,
        'tanggal_berangkat' => $request->tanggal_berangkat,
        'tanggal_pulang' => $request->tanggal_pulang,
        'status' => $request->status,
        'status_tampil' => $request->status_tampil,
        'catatan_lainnya' => $request->catatan_lainnya,
    ]);

        return redirect()->route('admin.catatan.index')
        ->with('success', 'Data berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $catatan = CatatanDinas::findOrFail($id);

    // Hapus data
        $catatan->delete();

        return redirect()->route('admin.catatan.index')->with('success', 'Data berhasil dihapus!');
    }

    public function Disetujui(String $id)
    {
        $catatan = CatatanDinas::findOrFail($id);
        $catatan->update([
            'status_tampil' => 'Disetujui',
        ]);

        return back()->with('success', 'Catatan dinas disetujui.');
    }

    public function Ditolak(Request $request, String $id)
    {
        $catatan = CatatanDinas::findOrFail($id);
        $catatan->update([
            'status_tampil' => 'Ditolak',
        ]);

        return back()->with('error', 'Catatan dinas ditolak.');
    }
}
