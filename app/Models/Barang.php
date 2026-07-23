<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Accessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;

    protected $fillable = ['nama', 'kategori_id', 'stok', 'stok_minimum', 'gambar'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function stokMovements(): HasMany
    {
        return $this->hasMany(StokMovement::class);
    }

    #[Accessor]
    public function getStatusAttribute(): string
    {
        if ($this->stok === 0) {
            return 'Habis';
        }

        if ($this->stok <= $this->stok_minimum) {
            return 'Menipis';
        }

        return 'Aman';
    }
}
