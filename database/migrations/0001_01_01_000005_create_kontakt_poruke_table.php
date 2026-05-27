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
    Schema::create('kontakt_poruke', function (Blueprint $table) {
    $table->id();
    $table->string('ime');
    $table->string('email');
    $table->string('predmet')->nullable();
    $table->text('poruka');
    $table->boolean('procitana')->default(false);
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
