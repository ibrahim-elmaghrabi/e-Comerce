<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CityTableSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\ColorTableSeeder;
use Database\Seeders\StoreTableSeeder;
use Database\Seeders\CountryTableSeeder;
use Database\Seeders\CategoryTableSeeder;

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
            CountryTableSeeder::class,
            CityTableSeeder::class,
            UserTableSeeder::class,
            StoreTableSeeder::class,
            CategoryTableSeeder::class,
            ColorTableSeeder::class
         ]);
    }
}
