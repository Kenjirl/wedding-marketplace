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
            'name'	=> 'Kencong',
            'email'	=> 'kenji@gmail.com',
            'email_verified_at'	=> now(),
            'password'	=> Hash::make('password'),
            'verification_code' => sha1(time()),
        ]);
    }
}
