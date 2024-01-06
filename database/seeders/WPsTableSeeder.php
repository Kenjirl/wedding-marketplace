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
                'user_id'        => 6,
                'nama'           => 'Budianto',
                'gender'         => 'Pria',
                'no_telp'        => '081212341234',
                'basis_operasi'  => 'Bisa ke Luar Kota',
                'status'         => 'Individu',
                'jenis_rekening' => 'BNI',
                'no_rekening'    => $this->generateRandomNumber(10),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'user_id'        => 7,
                'nama'           => 'Aniana',
                'gender'         => 'Wanita',
                'no_telp'        => '081212341234',
                'basis_operasi'  => 'Bisa ke Luar Kota',
                'status'         => 'Individu',
                'jenis_rekening' => 'BRI',
                'no_rekening'    => $this->generateRandomNumber(15),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        ]);
    }

    private function generateRandomNumber($length)
    {
        return str_pad(rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }
}
