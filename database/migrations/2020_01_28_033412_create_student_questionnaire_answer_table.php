<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentQuestionnaireAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_questionnaire_answer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_questionnaire_id')->unsigned();
            $table->bigInteger('questionnaire_question_id')->unsigned();

            $table->longText('answer')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('student_questionnaire_id')->references('id')->on('student_questionnaire')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('questionnaire_question_id')->references('id')->on('questionnaire_questions')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_questionnaire_answer');
    }
}
