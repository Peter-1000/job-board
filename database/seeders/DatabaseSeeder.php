<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(OurJobSeeder::class);
        $this->call(OurJobLanguageSeeder::class);
        $this->call(OurJobCategorySeeder::class);
        $this->call(OurJobCitySeeder::class);
    }
}
