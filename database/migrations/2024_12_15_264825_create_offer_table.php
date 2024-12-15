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
        Schema::create('offer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->string('title')->nullable(); ;
            $table->text('description')->nullable();
            $table->dateTime('expiration_date');
            $table->unsignedBigInteger('offer_type_id');
            $table->timestamps();

            $table->foreign('employer_id')->references('id')->on('employer')->onDelete('cascade');
            $table->foreign('offer_type_id')->references('id')->on('offer_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer');
    }
};
