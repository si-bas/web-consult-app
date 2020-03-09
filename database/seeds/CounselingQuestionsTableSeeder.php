<?php

use Illuminate\Database\Seeder;

# Models
use App\Models\Counseling\Question;

class CounselingQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::updateOrCreate([
            "order" => 1
        ], [
            "order" => 1,
            "text" => "Jelaskan masalah apa yang anda alami sekarang? diantara masalah yang kamu alami itu apa yang dianggap masalah besar dan harus diselesaikan",
        ]);

        Question::updateOrCreate([
            "order" => 2
        ], [
            "order" => 2,
            "text" => "Upaya / cara apa yang sudah anda lakukan untuk menghadapi masalah tersebut?",
        ]);

        Question::updateOrCreate([
            "order" => 3
        ], [
            "order" => 3,
            "text" => "Jelaskan bagaimana sikap keluarga dan teman saat anda mempunyai masalah tersebut?",
        ]);
    }
}
