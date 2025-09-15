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
            if (!Schema::hasColumn('church_user', 'role')) {
                $table->string('role')
                    ->default('member')
                    ->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('church_user', function (Blueprint $table) {
            if (Schema::hasColumn('church_user', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
