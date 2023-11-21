<?php

namespace Database\Seeders;

use App\Models\WOrganizer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WOsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('w_organizers')->insert([
            [
                'user_id'         => 4,
                'nama_pemilik'    => 'Bos Budi',
                'nama_perusahaan' => 'Ayo Nikah',
                'no_telp'         => '081212341234',
                'alamat'          => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi'   => 'Bisa ke Luar Kota',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'user_id'         => 5,
                'nama_pemilik'    => 'Bos Ani',
                'nama_perusahaan' => 'Sini Nikah',
                'no_telp'         => '081212341234',
                'alamat'          => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi'   => 'Bisa ke Luar Kota',
                'created_at'      => now(),
                'updated_at'      => now(),
            ]
        ]);
    }
}
