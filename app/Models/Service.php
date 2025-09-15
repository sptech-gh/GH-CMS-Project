<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'church_id', 'title', 'description', 'date', 'time'
    ];

    public function church()
    {
        return $this->belongsTo(Church::class, 'church_id');
    }
}
