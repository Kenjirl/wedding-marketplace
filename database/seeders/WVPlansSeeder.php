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
            ],
            [
                'w_vendor_id' => 1,
                'nama'        => 'Mahal',
                'detail'      => 'Ini detail',
                'harga'       => 12000000,
                'satuan'      => 'acara',
            ],
            [
                'w_vendor_id' => 2,
                'nama'        => 'Murah',
                'detail'      => 'Ini detail',
                'harga'       => 1000000,
                'satuan'      => 'acara',
            ],
            [
                'w_vendor_id' => 2,
                'nama'        => 'Mahal',
                'detail'      => 'Ini detail',
                'harga'       => 12000000,
                'satuan'      => 'acara',
            ],
            [
                'w_vendor_id' => 3,
                'nama'        => 'Murah',
                'detail'      => 'Ini detail',
                'harga'       => 1000000,
                'satuan'      => 'pack',
            ],
            [
                'w_vendor_id' => 3,
                'nama'        => 'Mahal',
                'detail'      => 'Ini detail',
                'harga'       => 12000000,
                'satuan'      => 'pack',
            ],
            [
                'w_vendor_id' => 4,
                'nama'        => 'Murah',
                'detail'      => 'Ini detail',
                'harga'       => 1000000,
                'satuan'      => 'hari',
            ],
            [
                'w_vendor_id' => 4,
                'nama'        => 'Mahal',
                'detail'      => 'Ini detail',
                'harga'       => 12000000,
                'satuan'      => 'hari',
            ],
        ]);
    }
}
