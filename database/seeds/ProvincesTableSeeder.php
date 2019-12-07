<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

# Models
use App\Models\Area\Province;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/provinces.csv'), 'r');
        foreach ($csv as $row) {
            Province::create([
                'code' => $row[1],
                'name' => $row[2]
            ]);
        }
    }
}
