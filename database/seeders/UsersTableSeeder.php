<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        User::create([
            'name'	=> 'Super Admin',
            'email'	=> 'superadmin@gmail.com',
            'email_verified_at'	=> now(),
            'password'	=> Hash::make('adminganteng285'),
            'verification_code' => sha1(time()),
            'role' => 'super-admin',
        ]);
    }
}
