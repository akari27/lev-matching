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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users','id');
            $table->foreignId('reciever_id')->constrained('users','id');
            $table->integer('permission_flag');
            $table->timestamps();
            // sender_idとreciever_idの各組み合わせは単一であってほしい(同じユーザに複数申請だめ)
            $table->unique(['sender_id', 'reciever_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
