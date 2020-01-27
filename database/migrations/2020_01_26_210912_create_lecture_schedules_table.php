<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturer_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lecturer_id')->unsigned();
            $table->bigInteger('day_id')->unsigned()->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('lecturer_id')->references('id')->on('lecturers')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('day_id')->references('id')->on('days')
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
        Schema::dropIfExists('lecture_schedules');
    }
}
