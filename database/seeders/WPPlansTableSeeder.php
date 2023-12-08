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
                'harga'          => 1000000,
            ],
            [
                'w_photographer_id' => 1,
                'nama'           => 'Mahal',
                'harga'          => 12000000,
            ],
            [
                'w_photographer_id' => 2,
                'nama'           => 'Murah',
                'harga'          => 1000000,
            ],
            [
                'w_photographer_id' => 2,
                'nama'           => 'Mahal',
                'harga'          => 12000000,
            ],
        ]);


        DB::table('w_p_plan_details')->insert([
            [
                'w_p_plan_id' => 1,
                'isi'         => 'Fitur A',
            ],
            [
                'w_p_plan_id' => 1,
                'isi'         => 'Fitur B',
            ],
            [
                'w_p_plan_id' => 2,
                'isi'         => 'Fitur A',
            ],
            [
                'w_p_plan_id' => 2,
                'isi'         => 'Fitur B',
            ],
            [
                'w_p_plan_id' => 2,
                'isi'         => 'Fitur C',
            ],
            [
                'w_p_plan_id' => 3,
                'isi'         => 'Fitur A',
            ],
            [
                'w_p_plan_id' => 3,
                'isi'         => 'Fitur B',
            ],
            [
                'w_p_plan_id' => 4,
                'isi'         => 'Fitur A',
            ],
            [
                'w_p_plan_id' => 4,
                'isi'         => 'Fitur B',
            ],
            [
                'w_p_plan_id' => 4,
                'isi'         => 'Fitur C',
            ],
        ]);
    }
}
