<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Employees')->insert([
            'name' => 'Pegawai 1',
            'email' => 'pegawai1@gmail.com',
            'nohp' => "0812" . rand(10000000, 99999999),
            'created_at' => now(),
        ]);
        DB::table('Employees')->insert([
            'name' => 'Pegawai 2',
            'email' => 'pegawai2@gmail.com',
            'nohp' => "0812" . rand(10000000, 99999999),
            'created_at' => now(),
        ]);
        DB::table('Employees')->insert([
            'name' => 'Pegawai 3',
            'email' => 'pegawai3@gmail.com',
            'nohp' => "0812" . rand(10000000, 99999999),
            'created_at' => now(),
        ]);
        DB::table('Employees')->insert([
            'name' => 'Pegawai 4',
            'email' => 'pegawai4@gmail.com',
            'nohp' => "0812" . rand(10000000, 99999999),
            'created_at' => now(),
        ]);
        DB::table('Employees')->insert([
            'name' => 'Pegawai 5',
            'email' => 'pegawai5@gmail.com',
            'nohp' => "0812" . rand(10000000, 99999999),
            'created_at' => now(),
        ]);
    }
}
