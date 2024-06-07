<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WCsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('w_couples')->insert([
            [
                'user_id' => 12,
                'nama' => 'Couple',
                'no_telp' => '123123123123',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
