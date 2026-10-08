<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pembayaran;

class Rental extends Model
{
    protected $fillable = [
    'mobil_id',
    'pelanggan_id',
    'tanggal_mulai',
    'jam_mulai',
    'tanggal_selesai',
    'jam_selesai',
    'jumlah_hari',
    'harga_per_hari',
    'total_harga',
    'status',
    'catatan',
];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'harga_per_hari' => 'decimal:2',
        'total_harga' => 'decimal:2',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    // ==========================================================
    // OTOMATIS: setiap status rental berubah, ikut update status mobil
    // ==========================================================
    protected static function booted()
    {
        static::updated(function (Rental $rental) {
            if ($rental->wasChanged('status')) {
                $rental->syncMobilStatus();
            }
        });
    }

    public function syncMobilStatus(): void
    {
        if (in_array($this->status, ['disetujui', 'berjalan'])) {
            $this->mobil()->update(['status' => 'disewa']);
        } elseif (in_array($this->status, ['selesai', 'dibatalkan'])) {
            $this->mobil()->update(['status' => 'tersedia']);
        }
    }
}