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
        'location',
        'region',
        'pastor_name',
        'founded_at',
        'description',
    ];

    /**
     * Boot model events for slug handling.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($church) {
            if (empty($church->slug)) {
                $church->slug = static::generateUniqueSlug($church->name);
            }
        });

        static::updating(function ($church) {
            // Only regenerate slug if name has changed
            if ($church->isDirty('name')) {
                $church->slug = static::generateUniqueSlug($church->name, $church->id);
            }
        });
    }

    /**
     * Generate a unique slug for church names.
     */
    private static function generateUniqueSlug(string $name, $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    /**
     * Use slug instead of ID in route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Relationships
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
