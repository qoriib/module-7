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
        Barang::create([
            'kode_barang' => 'BRG001',
            'nama_barang' => 'Keyboard Mechanical',
            'harga_barang' => '350000',
            'foto' => 'keyboard.jpg',
            'stok' => 20,
            'rating' => 4.5,
        ]);

        Barang::create([
            'kode_barang' => 'BRG002',
            'nama_barang' => 'Mouse Wireless',
            'harga_barang' => '150000',
            'foto' => 'mouse.jpg',
            'stok' => 35,
            'rating' => 4.3,
        ]);

        Barang::create([
            'kode_barang' => 'BRG003',
            'nama_barang' => 'Monitor LED 24"',
            'harga_barang' => '1250000',
            'foto' => 'monitor.jpg',
            'stok' => 10,
            'rating' => 4.8,
        ]);
    }
}
