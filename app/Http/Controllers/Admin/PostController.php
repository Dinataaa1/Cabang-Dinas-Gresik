<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();
        if ($request->has('type') && in_array($request->type, ['berita', 'pengumuman', 'inovasi', 'prestasi', 'kegiatan'])) {
            $query->where('type', $request->type);
        }
        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        Log::info('PostController@store called', $request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:berita,pengumuman,inovasi,prestasi,kegiatan',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'created_at' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $postData = [
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'content' => $request->content,
            'type' => $request->type,
            'image' => $imagePath,
        ];

        if ($request->filled('created_at')) {
            $postData['created_at'] = $request->created_at;
        }

        Post::create($postData);
        Log::info('Post created', ['slug' => $postData['slug'], 'type' => $postData['type']]);

        return redirect()->route('admin.posts.index', ['type' => $request->type])
            ->with('success', 'Konten berhasil ditambahkan!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        Log::info('PostController@update called', ['id' => $post->id, 'input' => $request->all()]);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:berita,pengumuman,inovasi,prestasi,kegiatan',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'created_at' => 'required|date',
        ]);

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $postData = [
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'content' => $request->content,
            'type' => $request->type,
            'image' => $imagePath,
        ];

        if ($request->filled('created_at')) {
            $postData['created_at'] = $request->created_at;
        }

        $post->update($postData);
        Log::info('Post updated', ['id' => $post->id, 'slug' => $postData['slug'], 'type' => $postData['type']]);

        return redirect()->route('admin.posts.index', ['type' => $request->type])
            ->with('success', 'Konten berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        $type = $post->type;
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('admin.posts.index', ['type' => $type])
            ->with('success', 'Konten berhasil dihapus!');
    }
}
