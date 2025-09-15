<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Church;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Ensure slug column exists (in case older installs didn’t add it)
        Schema::table('churches', function (Blueprint $table) {
            if (!Schema::hasColumn('churches', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('name');
            }
        });

        // Backfill slugs for existing rows
        foreach (Church::all() as $church) {
            if (empty($church->slug)) {
                $baseSlug = Str::slug($church->name);
                $slug = $baseSlug;
                $count = 1;

                // Ensure uniqueness
                while (Church::where('slug', $slug)->where('id', '!=', $church->id)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }

                $church->slug = $slug;
                $church->saveQuietly(); // avoid firing events
            }
        }
    }

    public function down(): void
    {
        // Optional rollback: just drop the slug column
        Schema::table('churches', function (Blueprint $table) {
            if (Schema::hasColumn('churches', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
