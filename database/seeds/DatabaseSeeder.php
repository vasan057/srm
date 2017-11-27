<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WelcomeMailTemplateTableSeeder::class);
        $this->call(FacultyTableSeeder::class);
        $this->call(FacultyTypeTableSeeder::class);
        $this->call(CountryTableSeeder::class);
    }
}
