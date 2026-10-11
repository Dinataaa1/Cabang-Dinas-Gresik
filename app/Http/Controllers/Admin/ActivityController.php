<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::orderByDesc('activity_date')->paginate(12);
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'location'      => 'nullable|string|max:255',
            'activity_date' => 'nullable|date',
            'category'      => 'required|in:umum,prestasi,sosial,olahraga,seni,pendidikan',
            'cover_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'images.*'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_published'  => 'nullable|boolean',
        ]);

        // Upload cover image
        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('activities', 'public');
        }

        // Upload multiple gallery images
        $galleryPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $galleryPaths[] = $img->store('activities', 'public');
            }
        }

        Activity::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title) . '-' . Str::random(5),
            'description'   => $request->description,
            'location'      => $request->location,
            'activity_date' => $request->activity_date,
            'category'      => $request->category,
            'cover_image'   => $coverPath,
            'images'        => $galleryPaths,
            'is_published'  => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.activities.index')
            ->with('success', '✅ Kegiatan berhasil ditambahkan!');
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'location'      => 'nullable|string|max:255',
            'activity_date' => 'nullable|date',
            'category'      => 'required|in:umum,prestasi,sosial,olahraga,seni,pendidikan',
            'cover_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'images.*'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_published'  => 'nullable|boolean',
            'delete_images' => 'nullable|array',
        ]);

        // Update cover image
        $coverPath = $activity->cover_image;
        if ($request->hasFile('cover_image')) {
            if ($coverPath) Storage::disk('public')->delete($coverPath);
            $coverPath = $request->file('cover_image')->store('activities', 'public');
        }

        // Delete selected gallery images
        $existingImages = $activity->images ?? [];
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $delImg) {
                Storage::disk('public')->delete($delImg);
                $existingImages = array_filter($existingImages, fn($i) => $i !== $delImg);
            }
            $existingImages = array_values($existingImages);
        }

        // Upload new gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $existingImages[] = $img->store('activities', 'public');
            }
        }

        $activity->update([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title) . '-' . Str::random(5),
            'description'   => $request->description,
            'location'      => $request->location,
            'activity_date' => $request->activity_date,
            'category'      => $request->category,
            'cover_image'   => $coverPath,
            'images'        => $existingImages,
            'is_published'  => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.activities.index')
            ->with('success', '✅ Kegiatan berhasil diperbarui!');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->cover_image) Storage::disk('public')->delete($activity->cover_image);
        foreach ($activity->images ?? [] as $img) {
            Storage::disk('public')->delete($img);
        }
        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('success', '🗑️ Kegiatan berhasil dihapus!');
    }
}
