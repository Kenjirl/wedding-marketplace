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
                'keterangan' => '<p>Acara pernikahan secara umum. Wajib ada di setiap wedding yang dibuat.</p>',
                'jenis' => 'Umum',
            ],
            [
                'admin_id' => 1,
                'nama' => 'Akad',
                'keterangan' => '<p>Pernikahan dalam Islam biasanya melibatkan akad nikah yang dilakukan oleh seorang imam atau wali (walinya, guardian)</p>',
                'jenis' => 'Islam',
            ],
            [
                'admin_id' => 1,
                'nama' => 'Kanyadaan',
                'keterangan' => '<p>Pemberian Putri</p>',
                'jenis' => 'Hindu',
            ],
            [
                'admin_id' => 1,
                'nama' => 'Panigrahana',
                'keterangan' => '<p>Pengambilan Tangan</p>',
                'jenis' => 'Hindu',
            ],
            [
                'admin_id' => 1,
                'nama' => 'Pemberkatan',
                'keterangan' => '<p>Pemberkatan mempelai di gereja</p>',
                'jenis' => 'Katolik',
            ],
            [
                'admin_id' => 1,
                'nama' => 'Pemberkatan',
                'keterangan' => '<p>Pemberkatan mempelai di gereja</p>',
                'jenis' => 'Protestan',
            ],
        ]);
    }
}
