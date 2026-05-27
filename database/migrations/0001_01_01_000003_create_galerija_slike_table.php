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
    Schema::create('galerija_slike', function (Blueprint $table) {
    $table->id();
    $table->string('naslov')->nullable();
    $table->string('slika');           // path u storage/
    $table->string('kategorija')->default('Ostalo');
    $table->date('datum')->nullable();
    $table->integer('redoslijed')->default(0);
    $table->timestamps();
    });
}

/**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
