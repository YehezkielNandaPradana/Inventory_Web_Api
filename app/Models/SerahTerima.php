<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SerahTerima extends Model
{
    protected $fillable = [
        'no_serah_terima', 'tanggal', 'dari_pihak', 'kepada_pihak',
        'dari_user_id', 'kepada_user_id', 'user_id', 'keterangan', 'status',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(DetailSerahTerima::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dariUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dari_user_id');
    }

    public function kepadaUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kepada_user_id');
    }
}
