<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

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
            DB::table('provinces')->insert([
                'code' => $row[1],
                'name' => $row[2],

                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
