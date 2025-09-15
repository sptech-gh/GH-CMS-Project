<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'church_id',
        'donor_name',
        'amount',
    ];

    // Optional: Relation to church
    public function church()
    {
        return $this->belongsTo(Church::class);
    }
}
