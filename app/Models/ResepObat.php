<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    protected $table = 'resep_obat';
    protected $guarded = [];

    public function riwayat()
    {
        return $this->belongsTo(RiwayatKesehatan::class, 'riwayat_kesehatan_id');
    }

    public function items()
    {
        return $this->hasMany(ResepObatItem::class, 'resep_obat_id');
    }
}
