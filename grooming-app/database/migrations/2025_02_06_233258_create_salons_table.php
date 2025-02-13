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
        Schema::create('salons', function (Blueprint $table) {
            $table->id(); // Primarni ključ
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Strani ključ
            $table->string('name'); // Naziv salona
            $table->string('phone')->nullable(); // Broj telefona salona
            $table->string('email')->nullable(); // Email salona
            $table->string('city')->nullable(); // Grad
            $table->string('address')->nullable(); // Adresa
            $table->string('area')->nullable(); // Deo grada
            $table->string('profile_image_url')->nullable(); //Profilna slika salona
            $table->timestamps(); // Vreme kreiranja i ažuriranja
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salons');
    }
};
