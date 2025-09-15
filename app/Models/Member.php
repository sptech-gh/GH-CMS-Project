<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'church_id',
        'name',
        'email',
        'phone',
<<<<<<< HEAD
        'church_id',
    ];

    /**
     * Auto-scope members to the current church.
     */
    protected static function booted()
    {
        static::addGlobalScope('church', function ($query) {
            if (app()->bound('currentChurch') && app('currentChurch')) {
                $query->where('church_id', app('currentChurch')->id);
            }
        });

        static::creating(function ($member) {
            if (app()->bound('currentChurch') && app('currentChurch')) {
                $member->church_id = app('currentChurch')->id;
            }
        });
    }

=======
        'address',
        'dob',
        'gender',
        'joined_at',
        'status',
    ];

    /**
     * Relationships
     */
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function donations()
    {
        // One member can have many donations
        return $this->hasMany(Donation::class);
    }
}
