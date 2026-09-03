<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->id('id_avis');
            $table->unsignedInteger('note');
            $table->text('commentaire')->nullable();
            $table->date('date_avis');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('hotel_id');

            $table->foreign('user_id')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('hotel_id')
                ->references('id_hotel')
                ->on('hotels')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
