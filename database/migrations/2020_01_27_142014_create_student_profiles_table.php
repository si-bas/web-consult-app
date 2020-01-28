<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned();

            $table->integer('age');
            $table->bigInteger('gender_id')->unsigned();
            $table->string('religion');
            $table->integer('semester');

            $table->bigInteger('major_id')->unsigned()->nullable();
            $table->string('classroom');

            $table->bigInteger('problem_solving_option_id')->unsigned()->nullable();
            $table->boolean('has_history_violence')->default(false);
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('gender_id')->references('id')->on('genders')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('major_id')->references('id')->on('majors')
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
        Schema::dropIfExists('student_profiles');
    }
}
