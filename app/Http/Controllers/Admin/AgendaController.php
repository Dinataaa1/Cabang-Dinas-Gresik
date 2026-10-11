<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderByDesc('event_date')->paginate(12);
        return view('admin.agendas.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agendas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'location'     => 'nullable|string|max:255',
            'event_date'   => 'nullable|date',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_published' => 'nullable|boolean',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('agendas', 'public');
        }

        Agenda::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . Str::random(5),
            'description'  => $request->description,
            'location'     => $request->location,
            'event_date'   => $request->event_date,
            'cover_image'  => $coverPath,
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda acara berhasil ditambahkan!');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agendas.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'location'     => 'nullable|string|max:255',
            'event_date'   => 'nullable|date',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_published' => 'nullable|boolean',
        ]);

        $coverPath = $agenda->cover_image;
        if ($request->hasFile('cover_image')) {
            if ($coverPath) Storage::disk('public')->delete($coverPath);
            $coverPath = $request->file('cover_image')->store('agendas', 'public');
        }

        $agenda->update([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . Str::random(5),
            'description'  => $request->description,
            'location'     => $request->location,
            'event_date'   => $request->event_date,
            'cover_image'  => $coverPath,
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda acara berhasil diperbarui!');
    }

    public function destroy(Agenda $agenda)
    {
        if ($agenda->cover_image) Storage::disk('public')->delete($agenda->cover_image);
        $agenda->delete();
        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil dihapus!');
    }
}