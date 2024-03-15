<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookedconfrencerooms', function (Blueprint $table) {
            $table->bigIncrements('booked_confrence_room_id');
            $table->string('username');
            $table->string('user_id');
            $table->string('user_email');
            $table->string('conference_room');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->json('participant_emails');
            $table->json('participant_names');
            $table->string('status');
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
        Schema::dropIfExists('bookedconfrencerooms');
    }
};
