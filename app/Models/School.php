<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'category',
        'name',
        'npsn',
        'address',
        'jumlah_guru',
        'jumlah_tendik',
        'jumlah_siswa',
        'siswa_x_l',
        'siswa_x_p',
        'siswa_xi_l',
        'siswa_xi_p',
        'siswa_xii_l',
        'siswa_xii_p',
        'jumlah_prestasi',
        'status',
        'is_active',
        'website',
    ];

    public static array $categories = ['SMA', 'SMK', 'PK/PLK'];
    public static array $statuses = ['Negeri', 'Swasta'];
}