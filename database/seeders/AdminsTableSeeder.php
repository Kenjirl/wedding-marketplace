<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'user_id'    => 2,
                'nama'       => 'Budi',
                'gender'     => 'Pria',
                'no_telp'    => '081212341234',
                'alamat'     => 'Jl. Besar no. 1, Jimbaran, Kuta Selatan, Badung, Bali',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
