<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('a_configurations')->insert([
            [
                'nama' => 'portofolio-automation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
