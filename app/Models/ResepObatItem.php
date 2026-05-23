<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepObatItem extends Model
{
    protected $table = 'resep_obat_item';
    protected $guarded = [];

    public function resep()
    {
        return $this->belongsTo(ResepObat::class, 'resep_obat_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
