<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'SMA');
        $schools = School::where('category', $category)->orderBy('name')->paginate(20);
        $categories = School::$categories;
        $statuses = School::$statuses;

        $totals = School::where('category', $category)->selectRaw('
            SUM(jumlah_guru) as total_guru,
            SUM(jumlah_siswa) as total_siswa,
            SUM(jumlah_prestasi) as total_prestasi,
            COUNT(*) as total_sekolah
        ')->first();

        return view('admin.schools.index', compact('schools', 'categories', 'category', 'totals', 'statuses'));
    }

    public function create(Request $request)
    {
        $categories = School::$categories;
        $statuses = School::$statuses;
        $selectedCategory = $request->get('category', 'SMA');
        return view('admin.schools.create', compact('categories', 'statuses', 'selectedCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'         => 'required|in:SMA,SMK,PK/PLK',
            'name'             => 'required|string|max:255',
            'npsn'             => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:500',
            'website'          => 'nullable|string|max:255',
            'jumlah_guru'      => 'required|integer|min:0',
            'jumlah_tendik'    => 'required|integer|min:0',
            'siswa_x_l'        => 'required|integer|min:0',
            'siswa_x_p'        => 'required|integer|min:0',
            'siswa_xi_l'       => 'required|integer|min:0',
            'siswa_xi_p'       => 'required|integer|min:0',
            'siswa_xii_l'      => 'required|integer|min:0',
            'siswa_xii_p'      => 'required|integer|min:0',
            'jumlah_prestasi'  => 'required|integer|min:0',
            'status'           => 'required|in:Negeri,Swasta',
        ]);

        $totalSiswa = (int) $request->siswa_x_l + (int) $request->siswa_x_p +
                      (int) $request->siswa_xi_l + (int) $request->siswa_xi_p +
                      (int) $request->siswa_xii_l + (int) $request->siswa_xii_p;

        $data = $request->only([
            'category', 'name', 'npsn', 'address', 'website',
            'jumlah_guru', 'jumlah_tendik', 'siswa_x_l', 'siswa_x_p',
            'siswa_xi_l', 'siswa_xi_p', 'siswa_xii_l', 'siswa_xii_p',
            'jumlah_prestasi', 'status', 'is_active'
        ]);
        $data['jumlah_siswa'] = $totalSiswa;

        School::create($data);

        return redirect()->route('admin.schools.index', ['category' => $request->category])
            ->with('success', 'Data sekolah berhasil ditambahkan!');
    }

    public function edit(School $school)
    {
        $categories = School::$categories;
        $statuses = School::$statuses;
        return view('admin.schools.edit', compact('school', 'categories', 'statuses'));
    }

    public function update(Request $request, School $school)
    {
        $request->validate([
            'category'         => 'required|in:SMA,SMK,PK/PLK',
            'name'             => 'required|string|max:255',
            'npsn'             => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:500',
            'website'          => 'nullable|string|max:255',
            'jumlah_guru'      => 'required|integer|min:0',
            'jumlah_tendik'    => 'required|integer|min:0',
            'siswa_x_l'        => 'required|integer|min:0',
            'siswa_x_p'        => 'required|integer|min:0',
            'siswa_xi_l'       => 'required|integer|min:0',
            'siswa_xi_p'       => 'required|integer|min:0',
            'siswa_xii_l'      => 'required|integer|min:0',
            'siswa_xii_p'      => 'required|integer|min:0',
            'jumlah_prestasi'  => 'required|integer|min:0',
            'status'           => 'required|in:Negeri,Swasta',
        ]);

        $totalSiswa = (int) $request->siswa_x_l + (int) $request->siswa_x_p +
                      (int) $request->siswa_xi_l + (int) $request->siswa_xi_p +
                      (int) $request->siswa_xii_l + (int) $request->siswa_xii_p;

        $data = $request->only([
            'category', 'name', 'npsn', 'address', 'website',
            'jumlah_guru', 'jumlah_tendik', 'siswa_x_l', 'siswa_x_p',
            'siswa_xi_l', 'siswa_xi_p', 'siswa_xii_l', 'siswa_xii_p',
            'jumlah_prestasi', 'status', 'is_active'
        ]);
        $data['jumlah_siswa'] = $totalSiswa;

        $school->update($data);

        return redirect()->route('admin.schools.index', ['category' => $school->category])
            ->with('success', 'Data sekolah berhasil diperbarui!');
    }

    public function destroy(School $school)
    {
        $cat = $school->category;
        $school->delete();
        return redirect()->route('admin.schools.index', ['category' => $cat])
            ->with('success', 'Data sekolah berhasil dihapus!');
    }
}