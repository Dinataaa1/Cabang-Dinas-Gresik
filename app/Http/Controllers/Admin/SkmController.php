<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkmResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkmController extends Controller
{
    public function index()
    {
        $total = SkmResponse::count();
        $questions = [
            'q1' => 'Persyaratan Pelayanan',
            'q2' => 'Prosedur / Alur Pelayanan',
            'q3' => 'Waktu Penyelesaian',
            'q4' => 'Biaya / Tarif',
            'q5' => 'Kualitas Hasil Pelayanan',
            'q6' => 'Kompetensi Petugas',
            'q7' => 'Perilaku Petugas',
            'q8' => 'Sarana dan Prasarana',
        ];

        $stats = [];
        $totalNrr = 0;
        if ($total > 0) {
            foreach (array_keys($questions) as $q) {
                $avg = SkmResponse::avg($q);
                $stats[$q] = [
                    'avg' => round($avg, 2),
                    'nrr' => round($avg * 25, 2),
                ];
                $totalNrr += $stats[$q]['nrr'];
            }
        }

        $ikm = $total > 0 ? round($totalNrr / 8, 2) : 0;
        $mutu  = $this->getMutu($ikm);
        $kinerja = $this->getKinerja($ikm);

        $saranList = SkmResponse::whereNotNull('saran')
            ->where('saran', '!=', '')
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        $responses = SkmResponse::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.skm.index', compact('total','questions','stats','ikm','mutu','kinerja','saranList','responses'));
    }

    public function report()
    {
        $total = SkmResponse::count();
        $questions = [
            'q1' => 'Persyaratan Pelayanan',
            'q2' => 'Prosedur / Alur Pelayanan',
            'q3' => 'Waktu Penyelesaian',
            'q4' => 'Biaya / Tarif',
            'q5' => 'Kualitas Hasil Pelayanan',
            'q6' => 'Kompetensi Petugas',
            'q7' => 'Perilaku Petugas',
            'q8' => 'Sarana dan Prasarana',
        ];

        $stats = [];
        $totalNrr = 0;
        foreach (array_keys($questions) as $q) {
            $avg = $total > 0 ? SkmResponse::avg($q) : 0;
            $stats[$q] = [
                'avg'  => round($avg, 2),
                'nrr'  => round($avg * 25, 2),
            ];
            $totalNrr += $stats[$q]['nrr'];
        }

        $ikm     = $total > 0 ? round($totalNrr / 8, 2) : 0;
        $mutu    = $this->getMutu($ikm);
        $kinerja = $this->getKinerja($ikm);

        $responseDist = [];
        foreach (array_keys($questions) as $q) {
            for ($v = 1; $v <= 4; $v++) {
                $responseDist[$q][$v] = SkmResponse::where($q, $v)->count();
            }
        }

        return view('admin.skm.report', compact('total','questions','stats','ikm','mutu','kinerja','responseDist'));
    }

    public function destroy(SkmResponse $skmResponse)
    {
        $skmResponse->delete();
        return redirect()->route('admin.skm.index')->with('success', 'Data responden berhasil dihapus.');
    }

    private function getMutu(float $ikm): string
    {
        if ($ikm >= 88.31) return 'A';
        if ($ikm >= 76.61) return 'B';
        if ($ikm >= 65.00) return 'C';
        return 'D';
    }

    private function getKinerja(float $ikm): string
    {
        if ($ikm >= 88.31) return 'Sangat Baik';
        if ($ikm >= 76.61) return 'Baik';
        if ($ikm >= 65.00) return 'Cukup';
        return 'Kurang';
    }
}
