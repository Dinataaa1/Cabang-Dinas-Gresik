<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('category')->orderBy('name')->paginate(15);
        $categories = Service::$categories;
        return view('admin.services.index', compact('services', 'categories'));
    }

    public function create()
    {
        $categories = Service::$categories;
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|in:SMA,SMK,Tata Usaha',
            'description'  => 'required|string',
            'requirements' => 'nullable|string',
            'procedure'    => 'nullable|string',
        ]);

        Service::create([
            'name'         => $request->name,
            'slug'         => Str::slug($request->name) . '-' . Str::random(5),
            'category'     => $request->category,
            'description'  => $request->description,
            'requirements' => $request->requirements,
            'procedure'    => $request->procedure,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Service $service)
    {
        $categories = Service::$categories;
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|in:SMA,SMK,Tata Usaha',
            'description'  => 'required|string',
            'requirements' => 'nullable|string',
            'procedure'    => 'nullable|string',
        ]);

        $service->update([
            'name'         => $request->name,
            'category'     => $request->category,
            'description'  => $request->description,
            'requirements' => $request->requirements,
            'procedure'    => $request->procedure,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
