<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WVsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('w_vendors')->insert([
            [
                'user_id'       => 4,
                'nama'          => 'Budi',
                'no_telp'       => '081212341234',
                'alamat'        => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi' => 'Bisa ke Luar Kota',
                'rekening'      => json_encode([['jenis' => 'BCA', 'nomor' => $this->generateRandomNumber(10)]]),
                'jenis'         => 'wedding-organizer',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 5,
                'nama'          => 'Ani',
                'no_telp'       => '081212341234',
                'alamat'        => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi' => 'Bisa ke Luar Kota',
                'rekening'      => json_encode([['jenis' => 'Mandiri', 'nomor' => $this->generateRandomNumber(13)]]),
                'jenis'         => 'wedding-organizer',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 6,
                'nama'          => 'Budianto',
                'no_telp'       => '081212341234',
                'alamat'        => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi' => 'Bisa ke Luar Kota',
                'rekening'      => json_encode([['jenis' => 'BNI', 'nomor' => $this->generateRandomNumber(10)]]),
                'jenis'         => 'photographer',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 7,
                'nama'          => 'Aniana',
                'no_telp'       => '081212341234',
                'alamat'        => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi' => 'Bisa ke Luar Kota',
                'rekening'      => json_encode([['jenis' => 'BRI', 'nomor' => $this->generateRandomNumber(15)]]),
                'jenis'         => 'photographer',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 8,
                'nama'          => 'Rumah Makan Enak',
                'no_telp'       => '081212341234',
                'alamat'        => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi' => 'Bisa ke Luar Kota',
                'rekening'      => json_encode([['jenis' => 'BNI', 'nomor' => $this->generateRandomNumber(10)]]),
                'jenis'         => 'catering',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 9,
                'nama'          => 'Bu Ida',
                'no_telp'       => '081212341234',
                'alamat'        => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi' => 'Bisa ke Luar Kota',
                'rekening'      => json_encode([['jenis' => 'BRI', 'nomor' => $this->generateRandomNumber(15)]]),
                'jenis'         => 'catering',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 10,
                'nama'          => 'Jagonya Gedung',
                'no_telp'       => '081212341234',
                'alamat'        => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi' => 'Bisa ke Luar Kota',
                'rekening'      => json_encode([['jenis' => 'BNI', 'nomor' => $this->generateRandomNumber(10)]]),
                'jenis'         => 'venue',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 11,
                'nama'          => 'Hohoho',
                'no_telp'       => '081212341234',
                'alamat'        => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'basis_operasi' => 'Bisa ke Luar Kota',
                'rekening'      => json_encode([['jenis' => 'BRI', 'nomor' => $this->generateRandomNumber(15)]]),
                'jenis'         => 'venue',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }

    private function generateRandomNumber($length)
    {
        return str_pad(rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }
}
