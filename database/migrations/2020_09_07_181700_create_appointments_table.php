<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('facebook')->nullable();
            $table->text('ActiveType');
            $table->text('fb_id')->nullable();
            $table->text('jour');
            $table->text('debut');
            $table->text('fin');

            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')
            ->references('id')->on('types')
            ->onDelete('cascade');
            
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')
            ->references('id')->on('clients')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
