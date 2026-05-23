<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';
    protected $guarded = [];

    public function resepItem()
    {
        return $this->hasMany(ResepObatItem::class, 'obat_id');
    }
}
