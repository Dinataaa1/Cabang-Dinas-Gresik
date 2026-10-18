<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'location',
        'activity_date', 'category', 'images', 'cover_image',
        'is_published', 'views',
    ];

    protected $casts = [
        'images'        => 'array',
        'activity_date' => 'date',
        'is_published'  => 'boolean',
    ];

    /**
     * Get the resolved URL for the cover image.
     */
    public function getCoverImageUrlAttribute(): ?string
    {
        if ($this->cover_image) {
            return \Illuminate\Support\Str::startsWith($this->cover_image, ['http://', 'https://'])
                ? $this->cover_image
                : asset('storage/' . $this->cover_image);
        }

        // Fallback to first image in images array if cover is not set
        $first = $this->all_photos[0] ?? null;
        return $first ?: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop';
    }

    /**
     * Get all resolved image URLs (cover + gallery) without duplicates.
     */
    public function getAllPhotosAttribute(): array
    {
        $photos = [];
        if ($this->cover_image) {
            $photos[] = \Illuminate\Support\Str::startsWith($this->cover_image, ['http://', 'https://'])
                ? $this->cover_image
                : asset('storage/' . $this->cover_image);
        }

        if (!empty($this->images) && is_array($this->images)) {
            foreach ($this->images as $img) {
                if (!$img) continue;
                $url = \Illuminate\Support\Str::startsWith($img, ['http://', 'https://'])
                    ? $img
                    : asset('storage/' . $img);
                if (!in_array($url, $photos)) {
                    $photos[] = $url;
                }
            }
        }

        return $photos;
    }
}

