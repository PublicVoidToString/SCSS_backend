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
        Schema::create('applications', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('student_id'); // Foreign key for student
            $table->unsignedBigInteger('offer_id'); // Foreign key for offer
            $table->string('cv')->nullable(); // Column to store CV file path
            $table->timestamps(); // Created and updated timestamps

            // Add foreign key constraints
            $table->foreign('student_id')->references('id')->on('student')->onDelete('cascade');
            $table->foreign('offer_id')->references('id')->on('offer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
