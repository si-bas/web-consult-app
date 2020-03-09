<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCounselingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_counselings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('counseling_question_id')->unsigned();
            $table->longText('answer')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('counseling_question_id')->references('id')->on('counseling_questions')
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
        Schema::dropIfExists('student_counselings');
    }
}
