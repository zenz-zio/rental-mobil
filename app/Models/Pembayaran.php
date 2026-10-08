<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Rental;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'order_id',
        'transaction_id',
        'gross_amount',
        'payment_type',
        'transaction_status',
        'payment_url',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'gross_amount' => 'decimal:2',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}