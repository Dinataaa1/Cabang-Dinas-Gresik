<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::orderBy('created_at', 'desc')->get();
        return view('admin.downloads.index', compact('downloads'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|in:Formulir,Regulasi,Laporan,Panduan,SKM',
            'description' => 'nullable|string|max:500',
            'file'        => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:20480',
        ]);

        $file      = $request->file('file');
        $filePath  = $file->store('downloads', 'public');
        $fileName  = $file->getClientOriginalName();
        $fileSize  = $this->formatBytes($file->getSize());

        Download::create([
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'file_path'   => $filePath,
            'file_name'   => $fileName,
            'file_size'   => $fileSize,
        ]);

        return redirect()->route('admin.downloads.index')->with('success', 'Dokumen berhasil diunggah!');
    }

    public function destroy(Download $download)
    {
        if ($download->file_path) Storage::disk('public')->delete($download->file_path);
        $download->delete();
        return redirect()->route('admin.downloads.index')->with('success', 'Dokumen berhasil dihapus!');
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024)    return round($bytes / 1024, 0) . ' KB';
        return $bytes . ' B';
    }
}
