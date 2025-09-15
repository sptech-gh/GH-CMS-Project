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
        Schema::table('church_user', function (Blueprint $table) {
            // Ensure role can store both 'admin' and 'member'
            $table->string('role', 20)->default('member')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('church_user', function (Blueprint $table) {
            // Revert to a shorter string (you can adjust as needed)
            $table->string('role', 10)->default('member')->change();
        });
    }
};
