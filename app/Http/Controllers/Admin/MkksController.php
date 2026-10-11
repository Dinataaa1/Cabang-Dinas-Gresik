<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MkksContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MkksController extends Controller
{
    public function index()
    {
        $sma = MkksContent::where('category', 'SMA')->first();
        $smk = MkksContent::where('category', 'SMK')->first();
        $pk = MkksContent::where('category', 'PK/PLK')->first();

        return view('admin.mkks.index', compact('sma', 'smk', 'pk'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'sma_title'             => 'required|string|max:255',
            'sma_content'           => 'required|string',
            'sma_jumlah_sekolah'    => 'required|integer|min:0',
            'sma_jumlah_prestasi'   => 'required|integer|min:0',
            'sma_jumlah_guru'       => 'required|integer|min:0',
            'sma_jumlah_tendik'     => 'required|integer|min:0',
            'sma_jumlah_siswa'      => 'required|integer|min:0',
            'sma_prestasi_unggulan' => 'nullable|string',
            'sma_images.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            
            'smk_title'             => 'required|string|max:255',
            'smk_content'           => 'required|string',
            'smk_jumlah_sekolah'    => 'required|integer|min:0',
            'smk_jumlah_prestasi'   => 'required|integer|min:0',
            'smk_jumlah_guru'       => 'required|integer|min:0',
            'smk_jumlah_tendik'     => 'required|integer|min:0',
            'smk_jumlah_siswa'      => 'required|integer|min:0',
            'smk_prestasi_unggulan' => 'nullable|string',
            'smk_images.*'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            
            'pk_title'              => 'required|string|max:255',
            'pk_content'            => 'required|string',
            'pk_jumlah_sekolah'     => 'required|integer|min:0',
            'pk_jumlah_prestasi'    => 'required|integer|min:0',
            'pk_jumlah_guru'        => 'required|integer|min:0',
            'pk_jumlah_tendik'      => 'required|integer|min:0',
            'pk_jumlah_siswa'       => 'required|integer|min:0',
            'pk_prestasi_unggulan'  => 'nullable|string',
            'pk_images.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        // 1. Update SMA
        $sma = MkksContent::where('category', 'SMA')->first();
        $smaImages = is_array($sma?->image) ? $sma->image : ($sma?->image ? [$sma->image] : []);
        if ($request->has('sma_delete_images')) {
            foreach ($request->sma_delete_images as $delImg) {
                Storage::disk('public')->delete($delImg);
                $smaImages = array_values(array_diff($smaImages, [$delImg]));
            }
        }
        if ($request->hasFile('sma_images')) {
            foreach ($request->file('sma_images') as $file) {
                $smaImages[] = $file->store('mkks', 'public');
            }
        }
        MkksContent::updateOrCreate(
            ['category' => 'SMA'],
            [
                'title'             => $request->sma_title,
                'content'           => $request->sma_content,
                'jumlah_sekolah'    => $request->sma_jumlah_sekolah,
                'jumlah_prestasi'   => $request->sma_jumlah_prestasi,
                'jumlah_guru'       => $request->sma_jumlah_guru,
                'jumlah_tendik'     => $request->sma_jumlah_tendik,
                'jumlah_siswa'      => $request->sma_jumlah_siswa,
                'prestasi_unggulan' => $request->sma_prestasi_unggulan,
                'image'             => $smaImages
            ]
        );

        // 2. Update SMK
        $smk = MkksContent::where('category', 'SMK')->first();
        $smkImages = is_array($smk?->image) ? $smk->image : ($smk?->image ? [$smk->image] : []);
        if ($request->has('smk_delete_images')) {
            foreach ($request->smk_delete_images as $delImg) {
                Storage::disk('public')->delete($delImg);
                $smkImages = array_values(array_diff($smkImages, [$delImg]));
            }
        }
        if ($request->hasFile('smk_images')) {
            foreach ($request->file('smk_images') as $file) {
                $smkImages[] = $file->store('mkks', 'public');
            }
        }
        MkksContent::updateOrCreate(
            ['category' => 'SMK'],
            [
                'title'             => $request->smk_title,
                'content'           => $request->smk_content,
                'jumlah_sekolah'    => $request->smk_jumlah_sekolah,
                'jumlah_prestasi'   => $request->smk_jumlah_prestasi,
                'jumlah_guru'       => $request->smk_jumlah_guru,
                'jumlah_tendik'     => $request->smk_jumlah_tendik,
                'jumlah_siswa'      => $request->smk_jumlah_siswa,
                'prestasi_unggulan' => $request->smk_prestasi_unggulan,
                'image'             => $smkImages
            ]
        );

        // 3. Update PK/PLK
        $pk = MkksContent::where('category', 'PK/PLK')->first();
        $pkImages = is_array($pk?->image) ? $pk->image : ($pk?->image ? [$pk->image] : []);
        if ($request->has('pk_delete_images')) {
            foreach ($request->pk_delete_images as $delImg) {
                Storage::disk('public')->delete($delImg);
                $pkImages = array_values(array_diff($pkImages, [$delImg]));
            }
        }
        if ($request->hasFile('pk_images')) {
            foreach ($request->file('pk_images') as $file) {
                $pkImages[] = $file->store('mkks', 'public');
            }
        }
        MkksContent::updateOrCreate(
            ['category' => 'PK/PLK'],
            [
                'title'             => $request->pk_title,
                'content'           => $request->pk_content,
                'jumlah_sekolah'    => $request->pk_jumlah_sekolah,
                'jumlah_prestasi'   => $request->pk_jumlah_prestasi,
                'jumlah_guru'       => $request->pk_jumlah_guru,
                'jumlah_tendik'     => $request->pk_jumlah_tendik,
                'jumlah_siswa'      => $request->pk_jumlah_siswa,
                'prestasi_unggulan' => $request->pk_prestasi_unggulan,
                'image'             => $pkImages
            ]
        );

        return redirect()->route('admin.mkks.index')->with('success', 'Konten MKKS dan data statistik berhasil diperbarui!');
    }
}
