<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quiz_id')->unsigned()->nullable();

            $table->integer('order')->default(1);
            $table->longText('html');
            $table->string('image')->nullable();

            $table->enum('type', ['free_text', 'single_select', 'multiple_select'])->default('free_text');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('quiz_id')->references('id')->on('quizzes')
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
        Schema::dropIfExists('quiz_questions');
    }
}
