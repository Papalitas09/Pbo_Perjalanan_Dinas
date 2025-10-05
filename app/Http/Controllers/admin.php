<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatatanDinas;
use Illuminate\Support\Facades\Auth;
use App\Models\pegawai;

class admin extends Controller
{
    public function index()
    {
        $pegawai = Auth::guard('pegawai')->user();

        $data = CatatanDinas::where('status_tampil', 'Tertunda')->whereHas('pegawai', function ($q) {
        $q->where('role', 'pegawai');})->get();

        $jumlahpegawai = Pegawai::where('role', 'pegawai')->count();
        $jumlahcatatan = CatatanDinas::count();
        return view('Admin.dahsboard', compact('data', 'jumlahpegawai', 'jumlahcatatan'));
    }
}
