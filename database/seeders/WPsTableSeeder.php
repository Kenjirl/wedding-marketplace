<?php

namespace Database\Seeders;

use App\Models\WPhotographer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WPsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('w_photographers')->insert([
            [
                'user_id'       => 6,
                'nama'          => 'Budianto',
                'gender'        => 'Pria',
                'no_telp'       => '081212341234',
                'alamat'        => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi' => 'Bisa ke Luar Kota',
                'status'        => 'Individu',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 7,
                'nama'          => 'Aniana',
                'gender'        => 'Pria',
                'no_telp'       => '081212341234',
                'alamat'        => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi' => 'Bisa ke Luar Kota',
                'status'        => 'Individu',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        ]);
    }
}
