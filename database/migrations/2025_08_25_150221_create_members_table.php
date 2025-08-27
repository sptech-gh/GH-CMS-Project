<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('church_id')->nullable();
            $table->timestamps();

            $table->foreign('church_id')->references('id')->on('churches')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
