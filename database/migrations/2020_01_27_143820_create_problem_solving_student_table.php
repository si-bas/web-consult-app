<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemSolvingStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_solving_student', function (Blueprint $table) {
            $table->bigInteger('problem_solving_option_id')->unsigned();
            $table->bigInteger('student_profile_id')->unsigned();

            $table->foreign('problem_solving_option_id')->references('id')->on('problem_solving_options')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('student_profile_id')->references('id')->on('student_profiles')
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
        Schema::dropIfExists('problem_solving_student');
    }
}
