<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MkksContent extends Model
{
    protected $fillable = [
        'category', 
        'title', 
        'content', 
        'image', 
        'jumlah_sekolah',
        'jumlah_prestasi', 
        'jumlah_guru', 
        'jumlah_tendik', 
        'jumlah_siswa', 
        'prestasi_unggulan'
    ];

    protected $casts = [
        'image' => 'array',
    ];
}
