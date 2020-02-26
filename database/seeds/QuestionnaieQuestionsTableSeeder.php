<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionnaieQuestionsTableSeeder extends Seeder
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

        foreach ($records as $row) {
            $row = collect($row);

            if(empty($row['deleted_at'])) DB::table('questionnaire_questions')->insert($row->except(['created_at', 'updated_at', 'deleted_at'])->toArray());
        }
    }
}
