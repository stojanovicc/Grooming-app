<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primarni ključ
            $table->string('owner_name'); // Ime vlasnika salona
            $table->string('email')->unique(); // Email
            $table->string('password'); // Lozinka
            $table->timestamps(); // Vreme kreiranja i ažuriranja
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
