<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

# Models
use App\Models\Questionnaire\Questionnaire;

class QuestionnaiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/questionnaires.csv'), 'r');
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader(); 
        $records = $csv->getRecords();

        Questionnaire::insert($records);
    }
}
