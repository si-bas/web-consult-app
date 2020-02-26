<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

# Models
use App\Models\Questionnaire\Answer;

class QuestionnaieAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/questionnaire_answers.csv'), 'r');
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader(); 
        $records = $csv->getRecords();

        Answer::insert($records);
    }
}
