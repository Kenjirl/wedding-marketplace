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
                'harga'          => 1000000,
            ],
            [
                'w_organizer_id' => 1,
                'nama'           => 'Mahal',
                'harga'          => 12000000,
            ],
            [
                'w_organizer_id' => 2,
                'nama'           => 'Murah',
                'harga'          => 1000000,
            ],
            [
                'w_organizer_id' => 2,
                'nama'           => 'Mahal',
                'harga'          => 12000000,
            ],
        ]);


        DB::table('w_o_plan_details')->insert([
            [
                'w_o_plan_id' => 1,
                'isi'         => 'Fitur A',
            ],
            [
                'w_o_plan_id' => 1,
                'isi'         => 'Fitur B',
            ],
            [
                'w_o_plan_id' => 2,
                'isi'         => 'Fitur A',
            ],
            [
                'w_o_plan_id' => 2,
                'isi'         => 'Fitur B',
            ],
            [
                'w_o_plan_id' => 2,
                'isi'         => 'Fitur C',
            ],
            [
                'w_o_plan_id' => 3,
                'isi'         => 'Fitur A',
            ],
            [
                'w_o_plan_id' => 3,
                'isi'         => 'Fitur B',
            ],
            [
                'w_o_plan_id' => 4,
                'isi'         => 'Fitur A',
            ],
            [
                'w_o_plan_id' => 4,
                'isi'         => 'Fitur B',
            ],
            [
                'w_o_plan_id' => 4,
                'isi'         => 'Fitur C',
            ],
        ]);
    }
}
