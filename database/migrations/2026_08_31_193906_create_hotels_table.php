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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id('id_hotel');

            $table->string('nom');
            $table->text('description')->nullable();
            $table->string('ville');
            $table->string('adresse');

            $table->decimal('prix', 10, 2);

            $table->string('type_hebergement');
            $table->integer('capacite');

            $table->boolean('disponibilite')->default(true);

            $table->foreignId('proprietaire_id')
                ->constrained('users', 'id_user')
                ->cascadeOnDelete();

            $table->string('statut')->default('en_attente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
