<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
        'church_id', // still used for members
=======
        // Removed 'church_id' because user can belong to multiple churches
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * A member belongs to a single church (via church_id).
     */
    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class, 'church_id');
    }

    /**
<<<<<<< HEAD
     * Admin/Pastor/Assistant can manage multiple churches (via pivot).
     */
    public function churches(): BelongsToMany
    {
        return $this->belongsToMany(Church::class, 'church_user')
            ->withPivot('role') // pivot role: admin, pastor, assistant
            ->withTimestamps();
    }

    /**
     * Convenience: return the member’s single church, or null if not a member.
     */
    public function memberChurch(): ?Church
    {
        return $this->church; // since members are tied via church_id
    }

    /**
     * Check if the user has a role in a given church.
     */
    public function hasChurchRole(Church $church, array $roles): bool
    {
        $membership = $this->churches()
            ->where('church_user.church_id', $church->id)
            ->select('church_user.role') // ✅ explicit
            ->first();

        return $membership && in_array($membership->pivot->role, $roles);
    }

    /**
     * Check if user manages multiple churches.
     */
    public function hasMultipleChurches(): bool
    {
        return $this->churches()->count() > 1;
    }

    /**
     * Check if user is Admin or Pastor in a given church.
     */
    public function isAdminOrPastor(?Church $church = null): bool
    {
        if ($church) {
            return $this->hasChurchRole($church, ['admin', 'pastor']);
        }

        // ✅ fix ambiguity by prefixing role column
        return $this->churches()
            ->whereIn('church_user.role', ['admin', 'pastor'])
            ->exists();
    }

    /**
     * Restrict who can access the Filament panel.
     * Only admins and pastors are allowed.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdminOrPastor();
=======
     * Many-to-Many Relationship: A user can belong to multiple churches
     */
    public function churches()
    {
          return $this->belongsTo(\App\Models\Church::class);
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    }
}
