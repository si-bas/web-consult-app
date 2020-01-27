<?php

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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(ProvincesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(SubdistrictsTableSeeder::class);
        $this->call(VillagesTableSeeder::class);

        $this->call(UniversityDataSeeder::class);
        $this->call(DaysTableSeeder::class);
    }
}
