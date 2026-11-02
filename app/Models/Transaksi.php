<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'pelanggan_id',
        'paket_id',
        'tanggal',
        'total_bayar',
        'status',
        'catatan',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class);
    }
}
