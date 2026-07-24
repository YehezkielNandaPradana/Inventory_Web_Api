<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailSerahTerima extends Model
{
    protected $fillable = [
        'serah_terima_id', 'barang_id', 'jumlah', 'kondisi', 'keterangan',
    ];

    public function serahTerima(): BelongsTo
    {
        return $this->belongsTo(SerahTerima::class);
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
