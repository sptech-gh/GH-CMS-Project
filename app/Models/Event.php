<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'church_id',
        'title',
        'description',
        'start_time',
        'end_time',
    ];

    public function church()
    {
        return $this->belongsTo(Church::class);
    }
}
