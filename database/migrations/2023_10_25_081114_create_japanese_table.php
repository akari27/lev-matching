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
        Schema::create('japanese', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('register_location_id')->constrained('japan_locations','id');
            $table->foreignId('often_go_location_id')->constrained('japan_locations','id');
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
        Schema::dropIfExists('japanese');
    }
};
