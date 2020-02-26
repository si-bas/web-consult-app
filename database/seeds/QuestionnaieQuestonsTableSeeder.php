<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;

# Models
use App\Models\Questionnaire\Question;

class QuestionnaieQuestonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath(storage_path('files/database-csv/questionnaire_questions.csv'), 'r');
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader(); 
        $records = $csv->getRecords();

        Question::insert($records);
    }
}
