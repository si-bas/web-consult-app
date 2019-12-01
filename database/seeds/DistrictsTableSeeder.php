<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;

# Models
use App\Models\Area\Province;

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
        $provinces = Province::all();

        foreach ($csv as $row) {
            try {
                $province = $provinces->where('code', $row[1])->first();
                
                DB::table('districts')->insert([
                    'province_id' => empty($province) ? null : $province->id,
                    'code' => "$row[2]",
                    'name' => $row[3],

                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } catch (\Exception $e) {
                Log::warning('Seeder district - '.$e->getMessage());
            }
        }
    }
}
