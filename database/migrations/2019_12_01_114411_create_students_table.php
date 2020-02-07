<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id_number');
            $table->string('first_name');
            $table->string('last_name');
            
            $table->bigInteger('gender_id')->unsigned()->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            
            $table->bigInteger('village_id')->unsigned()->nullable();
            $table->text('address')->nullable();
            
            $table->string('phone_number')->nullable();
            $table->text('current_address')->nullable();
            $table->string('high_school_name')->nullable();

            $table->bigInteger('major_id')->unsigned()->nullable();
            $table->string('semester')->nullable();
            $table->integer('year')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('village_id')->references('id')->on('villages')
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
        Schema::dropIfExists('students');
    }
}
