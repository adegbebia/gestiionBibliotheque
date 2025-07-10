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
        Schema::create('livre_emprunter', function (Blueprint $table) {
            $table->integer('livre_id');
            $table->integer('emprunt_id');

            $table->boolean('est_restituer')->default(false);

            $table->timestamps();

            $table->foreign('livre_id')->references('livre_id')->on('livres')->onDelete('cascade');
            $table->foreign('emprunt_id')->references('emprunt_id')->on('emprunts')->onDelete('cascade');

            $table->primary(['livre_id', 'emprunt_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livre_emprunter');
    }
};
