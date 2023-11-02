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
        Schema::create('foreign_visitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('register_location_id')->constrained('countrys','id');
            $table->foreignId('stay_location_id')->constrained('japan_locations','id');
            $table->date('start_of_stay');
            $table->date('end_of_stay');
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('foreign_visitors');
    }
};
