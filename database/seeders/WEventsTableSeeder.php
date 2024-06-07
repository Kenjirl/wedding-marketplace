<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WEventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('w_events')->insert([
            [
                'admin_id' => 1,
                'nama' => 'Pernikahan',
                'keterangan' => 'Acara pernikahan secara umum. Wajib ada di setiap wedding yang dibuat.',
                'jenis' => 'Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'admin_id' => 1,
                'nama' => 'Akad',
                'keterangan' => 'Pernikahan dalam Islam biasanya melibatkan akad nikah yang dilakukan oleh seorang imam atau wali (walinya, guardian)',
                'jenis' => 'Islam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'admin_id' => 1,
                'nama' => 'Kanyadaan',
                'keterangan' => 'Pemberian Putri',
                'jenis' => 'Hindu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'admin_id' => 1,
                'nama' => 'Panigrahana',
                'keterangan' => 'Pengambilan Tangan',
                'jenis' => 'Hindu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'admin_id' => 1,
                'nama' => 'Pemberkatan',
                'keterangan' => 'Pemberkatan mempelai di gereja',
                'jenis' => 'Katolik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'admin_id' => 1,
                'nama' => 'Pemberkatan',
                'keterangan' => 'Pemberkatan mempelai di gereja',
                'jenis' => 'Protestan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
