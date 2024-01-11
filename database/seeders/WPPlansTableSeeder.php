<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WPPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('w_p_plans')->insert([
            [
                'w_photographer_id' => 1,
                'nama'           => 'Murah',
                'detail'         => 'Ini detail',
                'harga'          => 1000000,
            ],
            [
                'w_photographer_id' => 1,
                'nama'           => 'Mahal',
                'detail'         => 'Ini detail',
                'harga'          => 12000000,
            ],
            [
                'w_photographer_id' => 2,
                'nama'           => 'Murah',
                'detail'         => 'Ini detail',
                'harga'          => 1000000,
            ],
            [
                'w_photographer_id' => 2,
                'nama'           => 'Mahal',
                'detail'         => 'Ini detail',
                'harga'          => 12000000,
            ],
        ]);
    }
}
