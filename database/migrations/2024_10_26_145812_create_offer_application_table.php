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
        Schema::create('offer_application', function (Blueprint $table) {
            $table->id();
            
            $table->integer('offer_id');
            $table->integer('student_id');
            $table->string('message');
            $table->string('cv_url')->nullable;
            $table->string('date');
            $table->integer('status');
            $table->timestamps();

            
            $table->foreign('offer_id')->references('id')->on('offer')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('student')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_application');
    }
};
