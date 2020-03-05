<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResultToStudentQuestionnaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_questionnaire', function (Blueprint $table) {
            $table->bigInteger('questionnaire_result_id')->unsigned()->nullable()->after('questionnaire_id');

            $table->foreign('questionnaire_result_id')->references('id')->on('questionnaire_results')
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
        Schema::table('student_questionnaire', function (Blueprint $table) {
            //
        });
    }
}
