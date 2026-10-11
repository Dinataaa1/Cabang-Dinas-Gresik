<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['title', 'category', 'description', 'file_path', 'file_name', 'file_size', 'download_count'];
}
