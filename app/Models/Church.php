<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Church extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'phone',
        'email',
        'website',
        'description',
        'founded_year',
    ];

    /**
     * Auto-generate a unique slug on create.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($church) {
            if (empty($church->slug)) {
                $baseSlug = Str::slug($church->name);
                $slug = $baseSlug;
                $i = 1;

                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $i++;
                }

                $church->slug = $slug;
            }
        });
    }
}
