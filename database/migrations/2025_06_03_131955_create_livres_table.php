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
        Schema::create('livres', function (Blueprint $table) {
            $table->id('livre_id');
            $table->string('titre');
            $table->string('auteur');
            $table->text('resume')->nullable(); 
            $table->string('pdf_url')->nullable(); 
            $table->string('isbn')->nullable();
            $table->integer('quantite')->default(1);
            //$table->boolean('disponible')->default(true);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livres');
    }
};
