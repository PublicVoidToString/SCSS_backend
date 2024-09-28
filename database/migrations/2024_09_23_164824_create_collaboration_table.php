<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collaboration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('careeroffice_id');
            $table->unsignedBigInteger('employer_id');
            $table->timestamps();

            $table->foreign('careeroffice_id')->references('id')->on('career_office')->onDelete('cascade');
            $table->foreign('employer_id')->references('id')->on('employer')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaboration');
    }
};
