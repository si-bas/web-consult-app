<?php

use Illuminate\Database\Seeder;

# Models
use App\Models\Profile\Gender;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::create([
            "code" => 'M',
            "name" => 'Laki-laki'
        ]);

        Gender::create([
            "code" => 'F',
            "name" => 'Perempuan'
        ]);
    }
}
