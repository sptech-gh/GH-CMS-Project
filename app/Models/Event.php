<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
        'title',
        'description',
        'event_date',
        'church_id',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Relationships
     */
    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    /**
     * Booted: apply church scoping automatically.
     */
    protected static function booted()
    {
        // Always scope to the current church if set
        static::addGlobalScope('church', function ($query) {
            if (app()->bound('currentChurch') && app('currentChurch')) {
                $query->where('church_id', app('currentChurch')->id);
            }
        });

        // When creating an event, auto-assign the active church
        static::creating(function ($event) {
            if (empty($event->church_id) && app()->bound('currentChurch') && app('currentChurch')) {
                $event->church_id = app('currentChurch')->id;
            }
        });
=======
        'church_id',
        'title',
        'description',
        'start_time',
        'end_time',
    ];

    public function church()
    {
        return $this->belongsTo(\App\Models\Church::class);
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    }
}
