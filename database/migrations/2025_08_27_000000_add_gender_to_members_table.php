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
        Schema::table('members', function (Blueprint $table) {
            // Add gender column if it doesn’t already exist
            if (!Schema::hasColumn('members', 'gender')) {
                $table->enum('gender', ['male', 'female', 'other'])
                      ->nullable()
                      ->after('phone');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (Schema::hasColumn('members', 'gender')) {
                $table->dropColumn('gender');
            }
        });
    }
};
