<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class SubdistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/subdistricts.csv'), 'r');
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader(); 
        $records = $csv->getRecords();

        foreach ($records as $row) {
            $data = [
                'id' => $row['id'],
                'code' => $row['code'],
                'name' => $row['name']
            ];

            $data = empty($row['district_id']) ? $data : array_merge($data, ['district_id' => $row['district_id']]);

            DB::table('subdistricts')->insert($data);
        }
    }
}
