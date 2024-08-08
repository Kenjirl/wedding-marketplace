<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'	            => 'Super Admin',
                'email'	            => 'superadmin@gmail.com',
                'email_verified_at'	=> now(),
                'password'	        => Hash::make('adminganteng123'),
                'verification_code' => sha1(time()),
                'role'              => 'super-admin',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'	            => 'Admin',
                'email'	            => 'admin@gmail.com',
                'email_verified_at'	=> now(),
                'password'	        => Hash::make('123456'),
                'verification_code' => sha1(time()),
                'role'              => 'admin',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'	            => 'Vendor',
                'email'	            => 'vendor@gmail.com',
                'email_verified_at'	=> now(),
                'password'	        => Hash::make('123456'),
                'verification_code' => sha1(time()),
                'role'              => 'vendor',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'	            => 'User 1',
                'email'	            => 'user@gmail.com',
                'email_verified_at'	=> now(),
                'password'	        => Hash::make('123456'),
                'verification_code' => sha1(time()),
                'role'              => 'user',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
