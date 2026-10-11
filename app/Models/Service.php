<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'slug', 'category', 'description', 'requirements', 'procedure'];

    public static array $categories = ['SMA', 'SMK', 'Tata Usaha'];
}
