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
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('student')->onDelete('cascade'); // Odniesienie do tabeli students
            $table->integer('frontend_points')->default(0);
            $table->integer('backend_points')->default(0);
            $table->integer('devops_points')->default(0);
            $table->integer('data_science_points')->default(0);
            $table->integer('cybersecurity_points')->default(0);
            $table->json('questions_data')->nullable(); // Zakładając, że chcesz przechowywać dane w formacie JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};
