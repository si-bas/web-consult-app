<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

# Models
use App\Models\Area\District;

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
        $districts = District::all();

        foreach ($csv as $row) {
            try {
                $district = $districts->where('code', $row[1])->first();
                
                DB::table('subdistricts')->insert([
                    'district_id' => empty($district) ? null : $district->id,
                    'code' => $row[2],
                    'name' => $row[3],

                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } catch (\Exception $e) {
                Log::warning('Seeder subdistrict - '.$e->getMessage());
            }
        }
    }
}
