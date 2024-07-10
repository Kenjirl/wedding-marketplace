<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MJenisVendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_jenis_vendors')->insert([
            [
                'nama' => 'Event Organizer',
                'icon' => 'fa-regular fa-building',
            ],
            [
                'nama' => 'Fotografer',
                'icon' => 'fa-solid fa-camera-retro',
            ],
            [
                'nama' => 'Catering',
                'icon' => 'fa-solid fa-utensils',
            ],
            [
                'nama' => 'Venue',
                'icon' => 'fa-solid fa-place-of-worship',
            ],
        ]);
    }
}
