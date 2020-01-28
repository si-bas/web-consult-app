<?php

use Illuminate\Database\Seeder;

# Models
use App\Models\Questionnaire\Problem_solving_option;

class ProblemSolvingOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Problem_solving_option::create([
            "name" => 'Bicara dengan teman'
        ]);

        Problem_solving_option::create([
            "name" => 'Bicara dengan keluarga'
        ]);

        Problem_solving_option::create([
            "name" => 'Disimpan sendiri'
        ]);
    }
}
