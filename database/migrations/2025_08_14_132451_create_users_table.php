<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
<<<<<<< HEAD
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');

        // NEW: role column (admin | member)
        $table->enum('role', ['admin', 'member'])->default('member');

        // For members only
        $table->foreignId('church_id')->nullable()->constrained()->onDelete('cascade');

        $table->rememberToken();
        $table->timestamps();
    });
=======
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // 🔑 Add church_id (each user belongs to a church)
            $table->foreignId('church_id')
                  ->nullable() // allow null in case user hasn’t been assigned yet
                  ->constrained() // references id on churches table
                  ->cascadeOnDelete();

            $table->rememberToken();
            $table->timestamps();
        });
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
