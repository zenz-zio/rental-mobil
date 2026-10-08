<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $fillable = [
        'merk',
        'model',
        'no_plat',
        'tahun',
        'harga_per_hari',
        'foto',
        'status',
        'transmisi',
        'tipe_mobil',
        'deskripsi',
    ];

    public function rentals()
{
    return $this->hasMany(Rental::class);
}
}