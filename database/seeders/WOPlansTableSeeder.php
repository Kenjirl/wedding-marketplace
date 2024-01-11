<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WOPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('w_o_plans')->insert([
            [
                'w_organizer_id' => 1,
                'nama'           => 'Murah',
                'detail'         => 'Ini detail',
                'harga'          => 1000000,
            ],
            [
                'w_organizer_id' => 1,
                'nama'           => 'Mahal',
                'detail'         => 'Ini detail',
                'harga'          => 12000000,
            ],
            [
                'w_organizer_id' => 2,
                'nama'           => 'Murah',
                'detail'         => 'Ini detail',
                'harga'          => 1000000,
            ],
            [
                'w_organizer_id' => 2,
                'nama'           => 'Mahal',
                'detail'         => 'Ini detail',
                'harga'          => 12000000,
            ],
        ]);
    }
}
