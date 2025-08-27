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
        'address',
        'date_of_birth',
        'gender',
        'church_id',
    ];

    // Relationship: a member belongs to a church
    public function church()
    {
        return $this->belongsTo(Church::class);
    }
}
