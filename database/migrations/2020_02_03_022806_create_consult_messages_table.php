<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consult_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('consult_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->longText('message');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('consult_id')->references('id')->on('consults')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('consult_messages');
    }
}
