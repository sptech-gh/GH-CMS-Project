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
        Schema::create('church_user', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('church_id')
                ->constrained('churches')
                ->cascadeOnDelete();

            // Role for this user in this church
            $table->enum('role', ['manager', 'admin', 'assistant'])
                ->default('manager');

            $table->timestamps();

            // Prevent duplicate user-church assignments
            $table->unique(['user_id', 'church_id'], 'church_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('church_user');
    }
};
