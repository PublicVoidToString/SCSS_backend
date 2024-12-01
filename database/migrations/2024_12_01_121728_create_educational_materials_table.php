<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('education_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('career_office_id');
            $table->text('description');
            $table->timestamps();

            $table->foreign('career_office_id')->references('id')->on('career_office')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_materials');
    }
};
