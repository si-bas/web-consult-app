<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/districts.csv'), 'r');
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader(); 
        $records = $csv->getRecords();

        foreach ($records as $row) {
            DB::table('districts')->insert([
                'id' => $row['id'],
                'code' => $row['code'],
                'name' => $row['name'],
                'province_id' => $row['province_id']
            ]);
        }
    }
}
