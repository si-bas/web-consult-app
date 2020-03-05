<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('questionnaire_id')->unsigned()->nullable();

            $table->integer('score_from');
            $table->integer('score_to');
            $table->string('information');

            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('questionnaire_results');
    }
}
