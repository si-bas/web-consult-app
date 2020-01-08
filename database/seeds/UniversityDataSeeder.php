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
            'code' => 'M',
            'name' => 'Matematika dan Ilmu Pengetahuan Alam'
        ]);

        $faculty->majors()->create([
            'code' => '31',
            'name' => 'Informatika'
        ]);
    }
}
