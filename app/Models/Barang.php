<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'harga_barang',
        'foto',
        'stok',
        'rating',
    ];

    /**
     * Relasi: Satu barang bisa muncul di banyak penjualan_barang.
     */
    public function penjualanBarangs()
    {
        return $this->hasMany(PenjualanBarang::class);
    }
}
