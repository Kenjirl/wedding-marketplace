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
                'password'	        => Hash::make('adminganteng285'),
                'verification_code' => sha1(time()),
                'role'              => 'super-admin',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'	            => 'Admin 1',
                'email'	            => 'admin1@gmail.com',
                'email_verified_at'	=> now(),
                'password'	        => Hash::make('asdasd'),
                'verification_code' => sha1(time()),
                'role'              => 'admin',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'	            => 'Admin 2',
                'email'	            => 'admin2@gmail.com',
                'email_verified_at'	=> now(),
                'password'	        => Hash::make('asdasd'),
                'verification_code' => sha1(time()),
                'role'              => 'admin',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'	            => 'Organizer 1',
                'email'	            => 'organizer1@gmail.com',
                'email_verified_at'	=> now(),
                'password'	        => Hash::make('asdasd'),
                'verification_code' => sha1(time()),
                'role'              => 'wedding-organizer',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'	            => 'Organizer 2',
                'email'	            => 'organizer2@gmail.com',
                'email_verified_at'	=> now(),
                'password'	        => Hash::make('asdasd'),
                'verification_code' => sha1(time()),
                'role'              => 'wedding-organizer',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'	            => 'Photographer 1',
                'email'	            => 'photographer1@gmail.com',
                'email_verified_at'	=> now(),
                'password'	        => Hash::make('asdasd'),
                'verification_code' => sha1(time()),
                'role'              => 'wedding-photographer',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'	            => 'Photographer 2',
                'email'	            => 'photographer2@gmail.com',
                'email_verified_at'	=> now(),
                'password'	        => Hash::make('asdasd'),
                'verification_code' => sha1(time()),
                'role'              => 'wedding-photographer',
                'created_at'        => now(),
                'updated_at'        => now(),
            ]
        ]);
    }
}
