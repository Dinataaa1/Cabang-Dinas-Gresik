<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkmResponse extends Model
{
    protected $fillable = [
        'nama', 'jenis_kelamin', 'usia', 'pendidikan', 'pekerjaan',
        'layanan_diterima', 'tanggal_pelayanan',
        'q1','q2','q3','q4','q5','q6','q7','q8','saran',
    ];

    protected $casts = [
        'tanggal_pelayanan' => 'date',
    ];

    // Calculate the IKM score for this response (avg of all 8 elements * 25)
    public function getIkmAttribute(): float
    {
        $avg = ($this->q1 + $this->q2 + $this->q3 + $this->q4 + $this->q5 + $this->q6 + $this->q7 + $this->q8) / 8;
        return round($avg * 25, 2);
    }

    public function getMutuAttribute(): string
    {
        $ikm = $this->ikm;
        if ($ikm >= 88.31) return 'A';
        if ($ikm >= 76.61) return 'B';
        if ($ikm >= 65.00) return 'C';
        return 'D';
    }
}
