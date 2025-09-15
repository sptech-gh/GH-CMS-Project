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
        Schema::table('churches', function (Blueprint $table) {
            if (Schema::hasColumn('churches', 'admin_id')) {
                $table->dropForeign(['admin_id']); // drop foreign key if exists
                $table->dropColumn('admin_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('churches', function (Blueprint $table) {
            if (!Schema::hasColumn('churches', 'admin_id')) {
                $table->foreignId('admin_id')
                    ->nullable()
                    ->constrained('users')
                    ->cascadeOnDelete();
            }
        });
    }
};
