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
            // Add gender column if not exists
            if (!Schema::hasColumn('members', 'gender')) {
                $table->enum('gender', ['male', 'female', 'other'])
                      ->nullable()
                      ->after('phone');
            }

            // Add date_of_birth column if not exists
            if (!Schema::hasColumn('members', 'date_of_birth')) {
                $table->date('date_of_birth')
                      ->nullable()
                      ->after('gender');
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
            if (Schema::hasColumn('members', 'date_of_birth')) {
                $table->dropColumn('date_of_birth');
            }
        });
    }
};
