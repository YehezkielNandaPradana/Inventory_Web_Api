<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Accessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $fillable = ['barang_id', 'jenis', 'jumlah', 'keterangan'];

    protected $appends = ['tanggal'];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }

    #[Accessor]
    public function getTanggalAttribute(): string
    {
        return $this->created_at?->format('Y-m-d') ?? '';
    }
}
