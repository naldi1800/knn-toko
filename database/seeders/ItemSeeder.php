<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'Paking kop/head', 'kode' => '6F5-11181-A2', 'harga' => 295000, 'merek' => 'YAMAHA'],
            ['name' => 'paking kop/head', 'kode' => '6F5-11181-A1', 'harga' => 130000, 'merek' => 'YOMS'],
            ['name' => 'paking vandasi mesin atas', 'kode' => '6F5-45113-A1', 'harga' => 230000, 'merek' => NULL],
            ['name' => 'paking vandasi mesin atas', 'kode' => '6F5-45113-A0', 'harga' => 75000, 'merek' => 'YOMS'],
            ['name' => 'Paking vandasi mesin bawah', 'kode' => '6F5-45114-A1', 'harga' => 140000, 'merek' => NULL],
            ['name' => 'Paking vandasi mesin bawah', 'kode' => '676-45114-A1', 'harga' => 55000, 'merek' => 'YOMS'],
            ['name' => 'Paking manifol dalam', 'kode' => '6F5-13646-A2', 'harga' => 115000, 'merek' => NULL],
            ['name' => 'Paking manifol dalam', 'kode' => '6F5-13646-A2', 'harga' => 45000, 'merek' => 'YOMS'],
            ['name' => 'Paking manifol luar', 'kode' => '6F5-13645-A1', 'harga' => 115000, 'merek' => NULL],
            ['name' => 'Paking manifol luar', 'kode' => '6F5-13645-A1', 'harga' => 45000, 'merek' => 'YOMS'],
            ['name' => 'Paking blok dalam', 'kode' => '6F5-41112-A0', 'harga' => 100000, 'merek' => NULL],
            ['name' => 'Paking blok dalam', 'kode' => '6F5-41112-A0', 'harga' => 65000, 'merek' => 'YOMS'],
            ['name' => 'Paking blok luar', 'kode' => '6F5-41114-A0', 'harga' => 100000, 'merek' => NULL],
            ['name' => 'Paking blok luar', 'kode' => '6F5-41114-A0', 'harga' => 50000, 'merek' => 'YOMS'],
            ['name' => 'Paking blok kop atas', 'kode' => '6F5-11193-A1', 'harga' => 130000, 'merek' => NULL],
            ['name' => 'Paking blok kop atas', 'kode' => '6F5-11193-A1', 'harga' => 45000, 'merek' => 'YOMS'],
            ['name' => 'Paking asli', 'kode' => '676-44316-A1', 'harga' => 50000, 'merek' => 'YAMAHA'],
            ['name' => 'Paking asli', 'kode' => '676-44315-A1', 'harga' => 45000, 'merek' => 'YAMAHA'],
            ['name' => 'Paking asli', 'kode' => '676-44324-A1', 'harga' => 45000, 'merek' => 'YAMAHA'],
            ['name' => 'Spare part asli', 'kode' => '6F5-13621-A1', 'harga' => 37000, 'merek' => 'YAMAHA'],
        ];

        // foreach ($items as $item) {
        //     DB::table('Items')->insert([
        //         'name' => $item['name'],
        //         'kode' => $item['kode'],
        //         'harga' => $item['harga'],
        //         'diskon' => 0,
        //         'merek' => $item['merek'],
        //         'stok' => rand(1, 15),
        //         'created_at' => now(),
        //     ]);
        // }
    }
}
