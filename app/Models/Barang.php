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

    protected $fillable = [
        'kode_barang', 'nama', 'kategori_id', 'gudang_id',
        'stok', 'stok_minimum', 'kondisi', 'gambar',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class);
    }

    public function stokMovements(): HasMany
    {
        return $this->hasMany(StokMovement::class);
    }

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    public function detailSerahTerimas(): HasMany
    {
        return $this->hasMany(DetailSerahTerima::class);
    }

    public function kondisiItems(): HasMany
    {
        return $this->hasMany(KondisiItem::class);
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
