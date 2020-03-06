<?php

use Illuminate\Database\Seeder;

# Models
use App\Models\Quiz\Quiz;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::create([
            "code" => 1,
            "name" => "Berfikir Negatif",
            "is_required" => true,        
            "is_active" => true,
        ]);

        Quiz::create([
            "code" => 2,
            "name" => "Motivasi Spiritual",
            "is_required" => true,        
            "is_active" => true,
        ]);

        Quiz::create([
            "code" => 3,
            "name" => "Afirmasi",
            "is_required" => true,        
            "is_active" => true,
        ]);
    }
}
