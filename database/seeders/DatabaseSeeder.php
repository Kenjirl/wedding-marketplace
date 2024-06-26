<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            AConfigTableSeeder::class,
            WEventsTableSeeder::class,
            WVsTableSeeder::class,
            WVPlansSeeder::class,
            WCsTableSeeder::class,
        ]);
    }
}
