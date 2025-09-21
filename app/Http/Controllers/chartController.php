<?php

namespace App\Http\Controllers;

use App\Models\CatatanDinas;
use Illuminate\Support\Facades\Auth;
use App\Models\pegawai;
use Illuminate\Http\Request;

class chartController extends Controller
{
    public function chartByRole()
    {
        $chart = pegawai::selectRaw('role, COUNT(*) as total')
                                ->groupBy('role')
                                ->pluck('total', 'role');

        $labels = $chart->keys();
        $totals = $chart->values();

        $pegawai = Auth::guard('pegawai')->user();

        $data = CatatanDinas::where('status_tampil', 'Tertunda')->whereHas('pegawai', function ($q) {
        $q->where('role', 'pegawai');})->get();

        return view('Admin.dahsboard', compact('labels', 'totals', 'data'));
    }
}
