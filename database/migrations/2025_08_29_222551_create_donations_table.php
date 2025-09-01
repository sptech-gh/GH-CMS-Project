<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            // Relationships
            $table->foreignId('church_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('member_id')
                  ->nullable()
                  ->constrained('members')
                  ->nullOnDelete();

            // Donation details
            $table->decimal('amount', 10, 2);
            $table->enum('method', ['momo', 'paystack', 'bank']);
            $table->string('reference')->unique();
            $table->enum('status', ['pending', 'successful', 'failed'])->default('pending');
            $table->text('notes')->nullable();

            // Metadata
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['church_id', 'member_id']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
