<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quiz_question_id')->unsigned()->nullable();
            
            $table->text('text')->nullable();
            $table->string('image')->nullable();
            $table->integer('poin')->nullable();

            $table->enum('type', ['radio', 'checkbox'])->default('radio');

            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('quiz_question_id')->references('id')->on('quiz_questions')
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
        Schema::dropIfExists('quiz_answers');
    }
}
