<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manufacturer::insert([
            [
                'title' => 'Apple'
            ],
            [
                'title' => 'Google'
            ],
            [
                'title' => 'Xiaomi'
            ],
            [
                'title' => 'Samsung'
            ],
            [
                'title' => 'Nokia'
            ]
        ]);
    }
}
