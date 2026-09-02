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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('id_reservation');

            $table->date('date_arrivee');
            $table->date('date_depart');

            $table->unsignedInteger('nb_personnes');

            $table->decimal('montant_total', 10, 2);

            $table->string('statut')->default('en_attente');

            $table->unsignedBigInteger('utilisateur_id');
            $table->unsignedBigInteger('hotel_id');

            $table->foreign('utilisateur_id')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('hotel_id')
                ->references('id_hotel')
                ->on('hotels')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
