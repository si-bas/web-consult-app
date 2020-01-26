<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToQuestionnaireQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questionnaire_questions', function (Blueprint $table) {
            $table->dropColumn('answer_text');

            $table->enum('type', ['free_text', 'single_select', 'multiple_select'])->default('free_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questionnaire_questions', function (Blueprint $table) {
            //
        });
    }
}
