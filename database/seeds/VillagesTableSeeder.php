<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class VillagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/villages.csv'), 'r');
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader(); 
        $records = $csv->getRecords();

        foreach ($records as $row) {
            $data = [
                'id' => $row['id'],
                'code' => $row['code'],
                'name' => $row['name']
            ];

            $data = empty($row['subdistrict_id']) ? $data : array_merge($data, ['subdistrict_id' => $row['subdistrict_id']]);

            DB::table('villages')->insert($data);
        }
    }
}
