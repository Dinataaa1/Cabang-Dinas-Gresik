<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'image'   => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'link_url'=> 'nullable|url',
            'order'   => 'nullable|integer|min:0',
        ]);

        $imagePath = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title'    => $request->title,
            'excerpt'  => $request->excerpt,
            'image'    => $imagePath,
            'link_url' => $request->link_url,
            'order'    => $request->order ?? 0,
            'is_active'=> $request->has('is_active'),
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil ditambahkan!');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'link_url'=> 'nullable|url',
            'order'   => 'nullable|integer|min:0',
        ]);

        $imagePath = $slider->image;
        if ($request->hasFile('image')) {
            if ($slider->image) Storage::disk('public')->delete($slider->image);
            $imagePath = $request->file('image')->store('sliders', 'public');
        }

        $slider->update([
            'title'    => $request->title,
            'excerpt'  => $request->excerpt,
            'image'    => $imagePath,
            'link_url' => $request->link_url,
            'order'    => $request->order ?? 0,
            'is_active'=> $request->has('is_active'),
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil diperbarui!');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) Storage::disk('public')->delete($slider->image);
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil dihapus!');
    }
}
