<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'church_id',
        'member_id',
        'amount',
        'method',
        'reference',
        'status',
        'notes',
    ];

    /**
     * Relationships
     */
    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function member()
    {
        // Nullable relationship — donor might be anonymous
        return $this->belongsTo(Member::class)->withDefault([
            'name' => 'Anonymous',
        ]);
    }
}
