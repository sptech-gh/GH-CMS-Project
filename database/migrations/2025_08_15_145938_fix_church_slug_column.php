<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop duplicate index if it exists
        try {
            DB::statement('ALTER TABLE churches DROP INDEX churches_slug_unique');
        } catch (\Exception $e) {
            // Ignore if index doesn't exist
        }

        Schema::table('churches', function (Blueprint $table) {
            if (!Schema::hasColumn('churches', 'slug')) {
                $table->string('slug')->unique()->after('name');
            } else {
                // Ensure slug column is unique
                $table->string('slug')->change();
                try {
                    $table->unique('slug');
                } catch (\Exception $e) {
                    // Ignore if already unique
                }
            }
        });

        // Auto-fill slug for existing churches
        $churches = DB::table('churches')->get();
        foreach ($churches as $church) {
            if (empty($church->slug)) {
                $slug = \Illuminate\Support\Str::slug($church->name);
                DB::table('churches')->where('id', $church->id)->update(['slug' => $slug]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('churches', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
