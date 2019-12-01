<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

# Models
use App\Models\Area\Subdistrict;

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
        $subdistricts = Subdistrict::all();

        foreach ($csv as $row) {
            try {
                $subdistrict = $subdistricts->where('code', $row[1])->first();

                DB::table('villages')->insert([
                    'subdistrict_id' => empty($subdistrict) ? null : $subdistrict->id,
                    'code' => "$row[2]",
                    'name' => $row[3],

                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } catch (\Exception $e) {
                Log::warning('Seeder village - '.$e->getMessage());
            }
        }
    }
}
