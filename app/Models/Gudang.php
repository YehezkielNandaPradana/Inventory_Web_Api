<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gudang extends Model
{
    protected $fillable = ['kode', 'nama', 'lokasi', 'keterangan'];

    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class);
    }
}
