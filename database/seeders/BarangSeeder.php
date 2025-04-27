<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            [
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Pisang Segar',
                'harga_barang' => 12000,
                'stok' => 100,
                'foto' => '/images/thumb-bananas.png',
                'rating' => 4.5,
            ],
            [
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Biskuit REnyah',
                'harga_barang' => 18000,
                'stok' => 80,
                'foto' => '/images/thumb-biscuits.png',
                'rating' => 4.2,
            ],
            [
                'kode_barang' => 'BRG003',
                'nama_barang' => 'Timun Segar',
                'harga_barang' => 10000,
                'stok' => 120,
                'foto' => '/images/thumb-cucumber.png',
                'rating' => 4.1,
            ],
            [
                'kode_barang' => 'BRG004',
                'nama_barang' => 'Susu Murni',
                'harga_barang' => 15000,
                'stok' => 90,
                'foto' => '/images/thumb-milk.png',
                'rating' => 4.3,
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::create([
                'kode_barang' => $barang['kode_barang'],
                'nama_barang' => $barang['nama_barang'],
                'harga_barang' => $barang['harga_barang'],
                'stok' => $barang['stok'],
                'foto' => $barang['foto'],
                'rating' => $barang['rating'],
            ]);
        }
    }
}
