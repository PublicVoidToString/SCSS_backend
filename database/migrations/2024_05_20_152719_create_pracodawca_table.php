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
        Schema::create('pracodawca', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('haslo');
            $table->string('nazwa_firmy');
            $table->string('nip')->nullable();
            $table->string('zdjecie')->nullable();
            $table->text('opis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pracodawca');
    }
};
