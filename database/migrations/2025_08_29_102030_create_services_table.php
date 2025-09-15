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
         Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->foreignId('church_id')->constrained()->onDelete('cascade');
        $table->string('name'); // Sunday Service, Bible Study, etc.
        $table->text('description')->nullable();
        $table->string('day_of_week')->nullable(); // e.g. Sunday, Wednesday
        $table->time('start_time')->nullable();
        $table->time('end_time')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
