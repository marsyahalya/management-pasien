<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $guarded = [];

    public function riwayatKesehatan()
    {
        return $this->hasMany(RiwayatKesehatan::class, 'pasien_id');
    }
}
