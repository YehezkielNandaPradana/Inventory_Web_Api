<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KondisiItem extends Model
{
    protected $fillable = [
        'barang_id', 'user_id', 'jumlah_baik', 'jumlah_rusak',
        'jumlah_perbaikan', 'keterangan', 'tanggal_pendataan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pendataan' => 'date',
        ];
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
