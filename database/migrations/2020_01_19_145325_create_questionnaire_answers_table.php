<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('questionnaire_question_id')->unsigned()->nullable();
            
            $table->text('text')->nullable();
            $table->string('image')->nullable();
            $table->integer('poin')->nullable();

            $table->enum('type', ['radio', 'checkbox'])->default('radio');

            $table->timestamps();
            $table->softDeletes();
            
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
        Schema::dropIfExists('questionnaire_answers');
    }
}
