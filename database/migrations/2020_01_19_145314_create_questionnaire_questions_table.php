<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('questionnaire_id')->unsigned()->nullable();

            $table->integer('order')->default(1);
            $table->longText('text');
            $table->string('image')->nullable();

            $table->boolean('answer_text')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')
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
        Schema::dropIfExists('questionnaire_questions');
    }
}
