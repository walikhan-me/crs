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
        Schema::create('adminlogins', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->string('admin_name');
            $table->string('admin_email');
            $table->string('admin_username');
            $table->string('admin_mobile');
            $table->string('admin_password');
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
        Schema::dropIfExists('adminlogins');
    }
};
