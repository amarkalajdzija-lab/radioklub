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
    Schema::create('vijesti', function (Blueprint $table) {
    $table->id();
    $table->string('naslov');
    $table->string('slug')->unique();
    $table->string('kategorija')->default('Info');
    $table->text('kratki_opis');
    $table->longText('tekst');
    $table->string('slika')->nullable();
    $table->boolean('featured')->default(false);
    $table->boolean('objavljena')->default(true);
    $table->date('datum');
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
