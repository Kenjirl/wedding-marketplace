<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MEventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_events')->insert([
            [
                'nama' => 'Pernikahan',
                'keterangan' => 'Acara pernikahan secara umum. Wajib ada di setiap wedding yang dibuat.',
                'jenis' => 'Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Akad',
                'keterangan' => 'Pernikahan dalam Islam biasanya melibatkan akad nikah yang dilakukan oleh seorang imam atau wali (walinya, guardian)',
                'jenis' => 'Islam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kanyadaan',
                'keterangan' => 'Pemberian Putri',
                'jenis' => 'Hindu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Panigrahana',
                'keterangan' => 'Pengambilan Tangan',
                'jenis' => 'Hindu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pemberkatan',
                'keterangan' => 'Pemberkatan mempelai di gereja',
                'jenis' => 'Katolik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pemberkatan',
                'keterangan' => 'Pemberkatan mempelai di gereja',
                'jenis' => 'Protestan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
