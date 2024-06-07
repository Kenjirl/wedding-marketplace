<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WVPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('w_v_plans')->insert([
            [
                'w_vendor_id' => 1,
                'nama'        => 'Murah',
                'detail'      => 'Ini detail',
                'harga'       => 1000000,
                'satuan'      => 'acara',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'w_vendor_id' => 1,
                'nama'        => 'Mahal',
                'detail'      => 'Ini detail',
                'harga'       => 12000000,
                'satuan'      => 'acara',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'w_vendor_id' => 2,
                'nama'        => 'Murah',
                'detail'      => 'Ini detail',
                'harga'       => 1000000,
                'satuan'      => 'acara',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'w_vendor_id' => 2,
                'nama'        => 'Mahal',
                'detail'      => 'Ini detail',
                'harga'       => 12000000,
                'satuan'      => 'acara',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'w_vendor_id' => 3,
                'nama'        => 'Murah',
                'detail'      => 'Ini detail',
                'harga'       => 1000000,
                'satuan'      => 'pack',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'w_vendor_id' => 3,
                'nama'        => 'Mahal',
                'detail'      => 'Ini detail',
                'harga'       => 12000000,
                'satuan'      => 'pack',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'w_vendor_id' => 4,
                'nama'        => 'Murah',
                'detail'      => 'Ini detail',
                'harga'       => 1000000,
                'satuan'      => 'hari',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'w_vendor_id' => 4,
                'nama'        => 'Mahal',
                'detail'      => 'Ini detail',
                'harga'       => 12000000,
                'satuan'      => 'hari',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
