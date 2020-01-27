<?php

use Illuminate\Database\Seeder;

# Models
use App\Models\Schedule\Day;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Day::create([
            "code" => 'all',
            "name" => 'Semua Hari'
        ]);
        
        Day::create([
            "code" => 'monday',
            "name" => 'Senin',
            "day_number" => 1,
        ]);

        Day::create([
            "code" => 'tuesday',
            "name" => 'Selasa',
            "day_number" => 2,
        ]);

        Day::create([
            "code" => 'wednesday',
            "name" => 'Rabu',
            "day_number" => 3,
        ]);

        Day::create([
            "code" => 'thursday',
            "name" => 'Kamis',
            "day_number" => 4,
        ]);

        Day::create([
            "code" => 'friday',
            "name" => 'Jum\'At',
            "day_number" => 5,
        ]);

        Day::create([
            "code" => 'saturday',
            "name" => 'Sabtu',
            "day_number" => 6,
        ]);

        Day::create([
            "code" => 'sunday',
            "name" => 'Minggu',
            "day_number" => 7,
        ]);
    }
}
