<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Church extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'location',
        'region',
        'founded_at',
        'description',
    ];

    /**
     * Members belonging to this church (regular users via church_id).
     */
    public function members(): HasMany
    {
        return $this->hasMany(User::class, 'church_id');
    }

    /**
     * Admins/Pastors/Assistants assigned via pivot table.
     */
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'church_user')
            ->withPivot('role') // role: admin, pastor, assistant
            ->withTimestamps();
    }

    /**
     * Inverse of User::churches() relation.
     * Allows attaching churches to a user in Filament.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'church_user')
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Events that belong to this church.
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'church_id');
    }

    /**
     * Use slug for route-model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Automatically generate a unique slug on creation.
     */
    protected static function booted()
    {
        static::creating(function ($church) {
            if (empty($church->slug)) {
                $baseSlug = Str::slug($church->name);
                $slug = $baseSlug;
                $count = 1;

                // Ensure uniqueness
                while (self::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }

                $church->slug = $slug;
            }
        });
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

<<<<<<< HEAD

=======
    public function events()
    {
        return $this->hasMany(Event::class);
    }
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Many-to-Many Relationship with Users
     */
<<<<<<< HEAD

=======
    public function users()
    {
        return $this->belongsToMany(User::class, 'church_user');
    }
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
}
