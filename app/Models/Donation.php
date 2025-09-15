<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'church_id',
<<<<<<< HEAD
        'donor_name',
        'amount',
    ];

    // Optional: Relation to church
=======
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
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    public function church()
    {
        return $this->belongsTo(Church::class);
    }
<<<<<<< HEAD
=======

    public function member()
    {
        // Nullable relationship — donor might be anonymous
        return $this->belongsTo(Member::class)->withDefault([
            'name' => 'Anonymous',
        ]);
    }
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
}
