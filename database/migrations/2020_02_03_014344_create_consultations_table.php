<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lecturer_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('lecturer_schedule_id')->unsigned()->nullable();

            $table->text('reason')->nullable();

            $table->boolean('is_meeting')->default(false);
            $table->boolean('is_done')->default(false);
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('lecturer_id')->references('id')->on('lecturers')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('student_id')->references('id')->on('students')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('lecturer_schedule_id')->references('id')->on('lecturer_schedules')
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
        Schema::dropIfExists('consultations');
    }
}
