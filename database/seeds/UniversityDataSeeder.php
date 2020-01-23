<?php

use Illuminate\Database\Seeder;

# Models
use App\Models\University\Faculty;

class UniversityDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculty = Faculty::create([
            "code" => 'K',
            "name" => 'Keperawatan'
        ]);
            
        $faculty->majors()->create([
            "code" => 'D3',
            "name" => 'D3',
        ]);

        $faculty->majors()->create([
            "code" => 'D4',
            "name" => 'D4',
        ]);
        
        $faculty->majors()->create([
            "code" => 'S1',
            "name" => 'S1',
        ]);
    }
}
