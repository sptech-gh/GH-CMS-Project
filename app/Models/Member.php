<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
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

    public function church()
    {
        return $this->belongsTo(Church::class);
    }
}
