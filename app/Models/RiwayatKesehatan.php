<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKesehatan extends Model
{
    protected $table = 'riwayat_kesehatan';
    protected $guarded = [];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function resep()
    {
        return $this->hasMany(ResepObat::class, 'riwayat_kesehatan_id');
    }
}
